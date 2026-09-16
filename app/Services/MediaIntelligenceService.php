<?php

namespace App\Services;

use App\Models\TrackedKeyword;
use App\Models\Mention;
use App\Models\MentionSource;
use App\Models\MentionCluster;
use App\Models\MonitoringProvider;
use App\Models\MonitoringRun;
use App\Models\AlertRule;
use App\Models\Alert;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MediaIntelligenceService
{
    /**
     * Run synchronization for a specific monitoring provider.
     */
    public function syncProvider(MonitoringProvider $provider): array
    {
        $run = MonitoringRun::create([
            'provider_id' => $provider->id,
            'status' => 'running',
            'items_fetched' => 0,
            'items_accepted' => 0,
            'items_rejected' => 0,
            'run_at' => now(),
        ]);

        try {
            $items = $this->fetchFromProvider($provider);
            $run->items_fetched = count($items);

            $accepted = 0;
            $rejected = 0;

            $activeKeywords = TrackedKeyword::where('is_active', true)->pluck('keyword')->toArray();

            foreach ($items as $item) {
                // 1. Check tracked keywords first
                $matchedKeyword = $this->checkKeywords($item['title'] . ' ' . $item['description'] . ' ' . $item['content'], $activeKeywords);

                if (!$matchedKeyword) {
                    $rejected++;
                    continue; // Skip items that don't match any keyword
                }

                // 2. Prevent direct duplicate based on URL or content hash
                $contentHash = md5($item['url'] . $item['title']);
                $exists = Mention::where('url', $item['url'])
                    ->orWhere('content_hash', $contentHash)
                    ->exists();

                if ($exists) {
                    continue;
                }

                // 3. AI / Entity Verification & Classification
                $analysis = $this->verifyAndClassify($item, $matchedKeyword);

                if (!$analysis['entity_confirmed']) {
                    $rejected++;
                    
                    // Log rejection in DB but flag it as entity_confirmed = false so it's not surfaced to users
                    $this->storeMention($provider, $item, $matchedKeyword, $contentHash, $analysis);
                    continue;
                }

                // 4. Duplicate Clustering
                $cluster = $this->findOrCreateCluster($item['title'], $analysis['sentiment'], $item['published_at']);

                // 5. Store the mention
                $mention = $this->storeMention($provider, $item, $matchedKeyword, $contentHash, $analysis, $cluster);
                $accepted++;

                // 6. Trigger notification rules
                $this->triggerAlertRules($mention, $cluster);
            }

            $run->status = 'success';
            $run->items_accepted = $accepted;
            $run->items_rejected = $rejected;
            $run->save();

            $provider->last_successful_sync = now();
            $provider->last_error = null;
            $provider->save();

            return [
                'status' => 'success',
                'fetched' => $run->items_fetched,
                'accepted' => $accepted,
                'rejected' => $rejected
            ];

        } catch (\Exception $e) {
            Log::error("Failed syncing provider {$provider->name}: " . $e->getMessage());

            $run->status = 'failed';
            $run->error_message = $e->getMessage();
            $run->save();

            $provider->last_error = $e->getMessage();
            $provider->save();

            return [
                'status' => 'failed',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Check if text contains any of the tracked keywords.
     */
    public function checkKeywords(string $text, array $keywords): ?string
    {
        $textLower = strtolower($text);
        
        // Sort keywords by length descending so that longer, more specific phrases match first
        usort($keywords, function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        foreach ($keywords as $keyword) {
            $keywordLower = strtolower($keyword);
            // Word boundary match to avoid partial substring issues
            $pattern = '/\b' . preg_quote($keywordLower, '/') . '\b/i';
            if (preg_match($pattern, $textLower)) {
                return $keyword;
            }
        }
        return null;
    }

    /**
     * Fetch raw items from the provider.
     */
    private function fetchFromProvider(MonitoringProvider $provider): array
    {
        $items = [];
        $keywords = TrackedKeyword::where('is_active', true)->pluck('keyword')->toArray();

        if (empty($keywords)) {
            return [];
        }

        switch ($provider->type) {
            case 'google_news':
                // Google News RSS allows querying keywords
                foreach ($keywords as $keyword) {
                    $url = 'https://news.google.com/rss/search?q=' . urlencode('"' . $keyword . '"') . '&hl=en-NG&gl=NG&ceid=NG:en';
                    $feedItems = $this->parseRSS($url);
                    foreach ($feedItems as $item) {
                        $items[] = $item;
                    }
                }
                break;

            case 'rss':
                $config = $provider->api_config;
                $feeds = $config['feeds'] ?? [];
                foreach ($feeds as $feedUrl) {
                    $feedItems = $this->parseRSS($feedUrl);
                    foreach ($feedItems as $item) {
                        $items[] = $item;
                    }
                }
                break;

            case 'social':
                // 1. Bluesky Public Search API (No keys required!)
                foreach ($keywords as $keyword) {
                    try {
                        $response = Http::get('https://public.api.bsky.app/xrpc/app.bsky.feed.searchPosts', [
                            'q' => $keyword,
                            'limit' => 15
                        ]);

                        if ($response->successful()) {
                            $data = $response->json();
                            $posts = $data['posts'] ?? [];
                            foreach ($posts as $post) {
                                $author = $post['author'] ?? [];
                                $record = $post['record'] ?? [];
                                $postId = str_replace('at://', '', $post['uri'] ?? '');
                                $postUrl = "https://bsky.app/profile/{$author['handle']}/post/" . basename($postId);

                                $items[] = [
                                    'title' => 'Bluesky post by @' . ($author['handle'] ?? 'user'),
                                    'description' => $record['text'] ?? '',
                                    'content' => $record['text'] ?? '',
                                    'url' => $postUrl,
                                    'published_at' => Carbon::parse($record['createdAt'] ?? now())->toDateTimeString(),
                                    'source_name' => 'Bluesky',
                                    'source_domain' => 'bsky.app',
                                    'logo_url' => 'https://bsky.app/static/favicon-32x32.png',
                                ];
                            }
                        }
                    } catch (\Exception $e) {
                        Log::warning("Bluesky search failed: " . $e->getMessage());
                    }
                }

                // 2. Twitter (X) Search v2 API
                $twitterToken = config('services.media.twitter_token');
                if (!empty($twitterToken)) {
                    foreach ($keywords as $keyword) {
                        try {
                            $response = Http::withToken($twitterToken)
                                ->get('https://api.twitter.com/2/tweets/search/recent', [
                                    'query' => '"' . $keyword . '"',
                                    'max_results' => 10,
                                    'tweet.fields' => 'created_at,author_id'
                                ]);

                            if ($response->successful()) {
                                $data = $response->json();
                                $tweets = $data['data'] ?? [];
                                foreach ($tweets as $tweet) {
                                    $tweetId = $tweet['id'];
                                    $authorId = $tweet['author_id'] ?? 'user';
                                    $tweetUrl = "https://x.com/{$authorId}/status/{$tweetId}";

                                    $items[] = [
                                        'title' => 'Tweet by X user ' . $authorId,
                                        'description' => $tweet['text'] ?? '',
                                        'content' => $tweet['text'] ?? '',
                                        'url' => $tweetUrl,
                                        'published_at' => Carbon::parse($tweet['created_at'] ?? now())->toDateTimeString(),
                                        'source_name' => 'Twitter (X)',
                                        'source_domain' => 'x.com',
                                        'logo_url' => 'https://abs.twimg.com/favicons/twitter.2.ico',
                                    ];
                                }
                            }
                        } catch (\Exception $e) {
                            Log::warning("Twitter API sync failed: " . $e->getMessage());
                        }
                    }
                }

                // 3. Facebook Graph API
                $fbToken = config('services.media.facebook_token');
                if (!empty($fbToken)) {
                    foreach ($keywords as $keyword) {
                        try {
                            $response = Http::get('https://graph.facebook.com/v19.0/pages/search', [
                                'q' => $keyword,
                                'access_token' => $fbToken,
                                'fields' => 'id,name,about,link'
                            ]);

                            if ($response->successful()) {
                                $data = $response->json();
                                $pages = $data['data'] ?? [];
                                foreach ($pages as $page) {
                                    $items[] = [
                                        'title' => 'Facebook Page match: ' . ($page['name'] ?? ''),
                                        'description' => $page['about'] ?? 'Public Page mention',
                                        'content' => $page['about'] ?? '',
                                        'url' => $page['link'] ?? "https://facebook.com/{$page['id']}",
                                        'published_at' => now()->toDateTimeString(),
                                        'source_name' => 'Facebook',
                                        'source_domain' => 'facebook.com',
                                        'logo_url' => 'https://facebook.com/favicon.ico',
                                    ];
                                }
                            }
                        } catch (\Exception $e) {
                            Log::warning("Facebook API sync failed: " . $e->getMessage());
                        }
                    }
                }

                // 4. Instagram Graph API (Hashtag search)
                $igToken = config('services.media.instagram_token');
                $igUserId = config('services.media.instagram_user_id');
                if (!empty($igToken) && !empty($igUserId)) {
                    foreach ($keywords as $keyword) {
                        try {
                            $tag = str_replace(' ', '', strtolower($keyword));
                            
                            $tagResponse = Http::get("https://graph.facebook.com/v19.0/ig_hashtag_search", [
                                'user_id' => $igUserId,
                                'q' => $tag,
                                'access_token' => $igToken
                            ]);

                            if ($tagResponse->successful()) {
                                $tagData = $tagResponse->json();
                                $hashtagId = $tagData['data'][0]['id'] ?? null;

                                if ($hashtagId) {
                                    $mediaResponse = Http::get("https://graph.facebook.com/v19.0/{$hashtagId}/recent_media", [
                                        'user_id' => $igUserId,
                                        'fields' => 'id,caption,permalink,timestamp',
                                        'access_token' => $igToken
                                    ]);

                                    if ($mediaResponse->successful()) {
                                        $mediaData = $mediaResponse->json();
                                        $posts = $mediaData['data'] ?? [];
                                        foreach ($posts as $post) {
                                            $items[] = [
                                                'title' => 'Instagram post: #' . $tag,
                                                'description' => $post['caption'] ?? '',
                                                'content' => $post['caption'] ?? '',
                                                'url' => $post['permalink'] ?? "https://instagram.com/p/{$post['id']}",
                                                'published_at' => Carbon::parse($post['timestamp'] ?? now())->toDateTimeString(),
                                                'source_name' => 'Instagram',
                                                'source_domain' => 'instagram.com',
                                                'logo_url' => 'https://instagram.com/static/images/ico/favicon-192.png/106a911fca69.png',
                                            ];
                                        }
                                    }
                                }
                            }
                        } catch (\Exception $e) {
                            Log::warning("Instagram API sync failed: " . $e->getMessage());
                        }
                    }
                }

                // 5. TikTok search API
                $tiktokToken = config('services.media.tiktok_token');
                if (!empty($tiktokToken)) {
                    foreach ($keywords as $keyword) {
                        try {
                            $response = Http::withToken($tiktokToken)
                                ->post('https://open.tiktokapis.com/v2/research/videos/query/', [
                                    'query' => [
                                        'and' => [
                                            ['field_name' => 'video_description', 'operation' => 'IN', 'field_values' => [$keyword]]
                                        ]
                                    ],
                                    'start_date' => now()->subDays(7)->format('Ymd'),
                                    'end_date' => now()->format('Ymd'),
                                    'max_results' => 10
                                ]);

                            if ($response->successful()) {
                                $data = $response->json();
                                $videos = $data['data']['videos'] ?? [];
                                foreach ($videos as $video) {
                                    $videoId = $video['id'];
                                    $items[] = [
                                        'title' => 'TikTok Video by @' . ($video['username'] ?? 'user'),
                                        'description' => $video['video_description'] ?? '',
                                        'content' => $video['video_description'] ?? '',
                                        'url' => "https://www.tiktok.com/@user/video/{$videoId}",
                                        'published_at' => Carbon::createFromTimestamp($video['create_time'] ?? time())->toDateTimeString(),
                                        'source_name' => 'TikTok',
                                        'source_domain' => 'tiktok.com',
                                        'logo_url' => 'https://www.tiktok.com/favicon.ico',
                                    ];
                                }
                            }
                        } catch (\Exception $e) {
                            Log::warning("TikTok Research API sync failed: " . $e->getMessage());
                        }
                    }
                }
                break;

            case 'newsapi':
                $apiKey = config('services.media.news_key');
                if (empty($apiKey)) {
                    throw new \Exception("NewsAPI credentials missing. Please set NEWS_PROVIDER_API_KEY.");
                }

                foreach ($keywords as $keyword) {
                    $response = Http::get('https://newsapi.org/v2/everything', [
                        'q' => '"' . $keyword . '"',
                        'apiKey' => $apiKey,
                        'pageSize' => 10,
                        'language' => 'en',
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $articles = $data['articles'] ?? [];
                        foreach ($articles as $article) {
                            $items[] = [
                                'title' => $article['title'] ?? '',
                                'description' => $article['description'] ?? '',
                                'content' => $article['content'] ?? '',
                                'url' => $article['url'] ?? '',
                                'published_at' => Carbon::parse($article['publishedAt'] ?? now())->toDateTimeString(),
                                'source_name' => $article['source']['name'] ?? 'NewsAPI',
                                'source_domain' => parse_url($article['url'] ?? '', PHP_URL_HOST),
                                'logo_url' => null,
                            ];
                        }
                    } else {
                        // Log rate limits or configuration errors
                        $provider->rate_limit_status = [
                            'code' => $response->status(),
                            'body' => $response->json()
                        ];
                        $provider->save();
                    }
                }
                break;

            case 'youtube':
                $apiKey = config('services.media.youtube_key');
                if (empty($apiKey)) {
                    throw new \Exception("YouTube API credentials missing. Please set YOUTUBE_API_KEY.");
                }

                foreach ($keywords as $keyword) {
                    $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
                        'part' => 'snippet',
                        'q' => $keyword,
                        'key' => $apiKey,
                        'type' => 'video',
                        'maxResults' => 10,
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $videos = $data['items'] ?? [];
                        foreach ($videos as $video) {
                            $snippet = $video['snippet'] ?? [];
                            $videoId = $video['id']['videoId'] ?? '';
                            $videoUrl = "https://www.youtube.com/watch?v={$videoId}";

                            $items[] = [
                                'title' => $snippet['title'] ?? '',
                                'description' => $snippet['description'] ?? '',
                                'content' => $snippet['description'] ?? '',
                                'url' => $videoUrl,
                                'published_at' => Carbon::parse($snippet['publishedAt'] ?? now())->toDateTimeString(),
                                'source_name' => 'YouTube',
                                'source_domain' => 'youtube.com',
                                'logo_url' => 'https://www.youtube.com/favicon.ico',
                            ];
                        }
                    }
                }
                break;
        }

        // Deduplicate fetched list by URL
        $unique = [];
        foreach ($items as $it) {
            if (!empty($it['url'])) {
                $unique[$it['url']] = $it;
            }
        }

        return array_values($unique);
    }

    /**
     * Parse RSS Feeds.
     */
    private function parseRSS(string $url): array
    {
        $items = [];
        try {
            $response = Http::timeout(10)->get($url);
            if (!$response->successful()) {
                return [];
            }

            $xml = @simplexml_load_string($response->body());
            if ($xml === false) {
                return [];
            }

            $channelTitle = (string) ($xml->channel->title ?? 'RSS Feed');
            $channelDomain = parse_url($url, PHP_URL_HOST);

            $entries = isset($xml->channel->item) ? $xml->channel->item : (isset($xml->entry) ? $xml->entry : []);

            foreach ($entries as $entry) {
                $title = (string) $entry->title;
                $link = (string) ($entry->link ?? $entry->link['href']);
                
                // Google News RSS links can be nested
                if (empty($link) && isset($entry->guid)) {
                    $link = (string) $entry->guid;
                }

                $desc = (string) ($entry->description ?? $entry->summary ?? $entry->content ?? '');
                
                // Parse date
                $pubDateStr = (string) ($entry->pubDate ?? $entry->published ?? $entry->updated ?? now());
                try {
                    $publishedAt = Carbon::parse($pubDateStr)->toDateTimeString();
                } catch (\Exception $e) {
                    $publishedAt = now()->toDateTimeString();
                }

                $items[] = [
                    'title' => trim(strip_tags($title)),
                    'description' => trim(strip_tags($desc)),
                    'content' => trim(strip_tags($desc)),
                    'url' => trim($link),
                    'published_at' => $publishedAt,
                    'source_name' => $channelTitle,
                    'source_domain' => $channelDomain,
                    'logo_url' => null,
                ];
            }
        } catch (\Exception $e) {
            Log::warning("Failed parsing RSS feed {$url}: " . $e->getMessage());
        }

        return $items;
    }

    /**
     * Verify the mention against false-positives and perform sentiment, topic, and importance classification.
     */
    public function verifyAndClassify(array $item, string $matchedKeyword): array
    {
        $apiKey = config('services.media.gemini_key') ?: config('services.gemini.key');
        $text = $item['title'] . "\n\n" . $item['description'] . "\n\n" . $item['content'];

        if (!empty($apiKey)) {
            try {
                $prompt = "You are an advanced Media Intelligence classifier. Analyze if the following text is genuinely about the political candidate/philanthropist/businessman Dr. Ifeanyi Chukwuma Odii (also known as Ifeanyichukwu Odii, Anyichuks, PDP candidate for Ebonyi State, Chief Ifeanyi Odii, etc.). Note that there may be other people named 'Odii' or 'Chuks'. Determine if this content refers specifically to him. 

Text to analyze:
\"{$text}\"

Return a JSON object exactly with the following keys. Do not include any markdown styling (like ```json) or explanation outside the JSON:
{
  \"entity_confirmed\": true or false,
  \"confidence_score\": float between 0.0 and 1.0,
  \"matched_keyword\": \"{$matchedKeyword}\",
  \"sentiment\": \"positive\", \"neutral\", \"negative\", or \"mixed\",
  \"category\": \"Politics\", \"Campaign\", \"Elections\", \"Philanthropy\", \"Business\", \"Community Development\", \"Interview\", \"Public Statement\", \"Controversy\", \"Misinformation/Claim\", or \"Other\",
  \"importance\": \"Breaking\", \"High\", \"Medium\", or \"Low\",
  \"reason\": \"brief 1-sentence reason for entity confirmation & classification\",
  \"summary\": \"1-2 sentence objective summary of the mention\"
}";

                $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json',
                    ]
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $textResult = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    $result = json_decode($textResult, true);

                    if ($result && isset($result['entity_confirmed'])) {
                        // Clean up model outputs to match exact formatting requirements
                        $result['sentiment'] = strtolower($result['sentiment'] ?? 'neutral');
                        $result['importance'] = strtolower($result['importance'] ?? 'low');
                        return $result;
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Gemini API call failed, falling back to heuristics: " . $e->getMessage());
            }
        }

        // Fallback Heuristics Classifier
        return $this->heuristicClassification($text, $matchedKeyword);
    }

    /**
     * Fallback Heuristic Classifier (Rule-based)
     */
    private function heuristicClassification(string $text, string $matchedKeyword): array
    {
        $textLower = strtolower($text);

        // Heuristic Context Clues for Entity Verification
        $contextWords = [
            'ifeanyi', 'anyichuks', 'ebonyi', 'governor', 'pdp', 'foundation', 
            'philanthrop', 'scholarship', 'ebele', 'orient global', 'manufacturing', 
            'conglomerate', 'abakaliki', 'candidate', 'governorship'
        ];

        $contextMatchCount = 0;
        foreach ($contextWords as $word) {
            if (str_contains($textLower, $word)) {
                $contextMatchCount++;
            }
        }

        // Determine if entity is confirmed
        // If matched keyword is already specific like "Ifeanyi Chukwuma Odii" or "Anyichuks", we confirm it.
        // If it only matches "Ifeanyi Odii" or "Odii", we require context match counts.
        $specificKeywords = [
            'ifeanyichukwu odii', 'ifeanyi chukwuma odii', 'ifeanyi-chukwuma odii', 
            'chief ifeanyi odii', 'dr ifeanyichukwu odii', 'anyichuks', 'anyichuks', 
            'anyichuks', 'anyi chuks', 'anyi ga emeya', 'pdp candidate ebonyi state', 
            'pdp governorship candidate ebonyi', 'ebonyi pdp candidate', 'ebonyi 2027 pdp candidate'
        ];

        $isSpecificKeyword = in_array(strtolower($matchedKeyword), $specificKeywords);
        
        $entityConfirmed = false;
        $confidenceScore = 0.50;
        $reason = "Matches keyword but lacks context clues.";

        if ($isSpecificKeyword) {
            $entityConfirmed = true;
            $confidenceScore = 0.95;
            $reason = "Matched highly specific tracked keyword '{$matchedKeyword}'.";
        } elseif ($contextMatchCount >= 1) {
            $entityConfirmed = true;
            $confidenceScore = 0.80;
            $reason = "Matched keyword '{$matchedKeyword}' and found {$contextMatchCount} context clues.";
        } else {
            $entityConfirmed = false;
            $confidenceScore = 0.30;
            $reason = "Rejected: matched '{$matchedKeyword}' but lacks corroborative context clues (e.g. Ebonyi, PDP, Ifeanyi).";
        }

        // Heuristic Sentiment Classifier
        $positiveWords = ['donated', 'successful', 'won', 'praise', 'charity', 'award', 'empower', 'support', 'visionary', 'progress', 'applauds', 'excellent'];
        $negativeWords = ['clash', 'protest', 'defeat', 'crisis', 'reject', 'claim', 'accusation', 'scandal', 'corrupt', 'fraud', 'failure', 'investigation', 'oppose'];

        $posCount = 0;
        $negCount = 0;
        foreach ($positiveWords as $w) {
            if (str_contains($textLower, $w)) $posCount++;
        }
        foreach ($negativeWords as $w) {
            if (str_contains($textLower, $w)) $negCount++;
        }

        $sentiment = 'neutral';
        if ($posCount > 0 && $negCount > 0) {
            $sentiment = 'mixed';
        } elseif ($posCount > $negCount) {
            $sentiment = 'positive';
        } elseif ($negCount > $posCount) {
            $sentiment = 'negative';
        }

        // Heuristic Category Classifier
        $category = 'Other';
        if (preg_match('/(pdp|governorship|guber|candidate|election|political|politics|2027|vote)/i', $textLower)) {
            $category = 'Politics';
        } elseif (preg_match('/(philanthrop|donat|widow|scholarship|housing|poverty|foundation|ebele)/i', $textLower)) {
            $category = 'Philanthropy';
        } elseif (preg_match('/(business|orient|logistics|manufacturing|group|chairman|ultimus)/i', $textLower)) {
            $category = 'Business';
        } elseif (preg_match('/(interview|statement|press|declare)/i', $textLower)) {
            $category = 'Public Statement';
        }

        // Heuristic Importance Classifier
        $importance = 'low';
        if (str_contains($textLower, 'breaking') || str_contains($textLower, 'urgent')) {
            $importance = 'breaking';
        } elseif ($category === 'Politics' || $sentiment === 'negative') {
            $importance = 'high';
        } elseif ($contextMatchCount >= 2) {
            $importance = 'medium';
        }

        $summary = Str::limit($text, 150, '...');

        return [
            'entity_confirmed' => $entityConfirmed,
            'confidence_score' => $confidenceScore,
            'matched_keyword' => $matchedKeyword,
            'sentiment' => $sentiment,
            'category' => $category,
            'importance' => $importance,
            'reason' => $reason,
            'summary' => $summary
        ];
    }

    /**
     * Group syndications or duplicate coverages.
     */
    public function findOrCreateCluster(string $title, string $sentiment, string $publishedAt): MentionCluster
    {
        $cleanWords = $this->getCleanWords($title);
        if (empty($cleanWords)) {
            return MentionCluster::create([
                'title' => $title,
                'first_detected_at' => now(),
                'last_updated_at' => now(),
                'overall_sentiment' => $sentiment,
            ]);
        }

        // Find clusters created in the last 7 days
        $recentClusters = MentionCluster::where('created_at', '>=', now()->subDays(7))->get();

        foreach ($recentClusters as $cluster) {
            $clusterWords = $this->getCleanWords($cluster->title);
            if (empty($clusterWords)) {
                continue;
            }
            
            $intersection = array_intersect($cleanWords, $clusterWords);
            $similarity = count($intersection) / max(count($cleanWords), count($clusterWords));

            if ($similarity >= 0.55) {
                // Found matched cluster! Update the latest update time
                $cluster->last_updated_at = Carbon::parse($publishedAt);
                
                // Simple sentiment recalculation
                // Count sentiments of all mentions in this cluster and pick the dominant one
                $cluster->save();
                return $cluster;
            }
        }

        // No matching cluster, create a new one
        return MentionCluster::create([
            'title' => $title,
            'first_detected_at' => Carbon::parse($publishedAt),
            'last_updated_at' => Carbon::parse($publishedAt),
            'overall_sentiment' => $sentiment,
        ]);
    }

    private function getCleanWords(string $text): array
    {
        $text = strtolower($text);
        // Strip punctuation
        $text = preg_replace('/[^\w\s]/u', '', $text);
        $words = explode(' ', $text);
        return array_filter($words, function ($word) {
            return strlen($word) > 3; // ignore tiny words
        });
    }

    /**
     * Store processed Mention records to database.
     */
    private function storeMention(
        MonitoringProvider $provider, 
        array $item, 
        string $matchedKeyword, 
        string $contentHash, 
        array $analysis, 
        MentionCluster $cluster = null
    ): Mention {
        // Resolve Source Publisher
        $domain = $item['source_domain'] ?: parse_url($item['url'], PHP_URL_HOST) ?: 'local';
        $source = MentionSource::firstOrCreate(
            ['domain' => $domain],
            [
                'name' => $item['source_name'] ?: 'Web Link',
                'logo_url' => $item['logo_url'] ?: 'https://www.google.com/s2/favicons?domain=' . $domain . '&sz=64'
            ]
        );

        return Mention::create([
            'mention_cluster_id' => $cluster?->id,
            'mention_source_id' => $source->id,
            'provider_id' => $provider->id,
            'title' => $item['title'],
            'description' => $item['description'],
            'content' => $item['content'],
            'url' => $item['url'],
            'canonical_url' => $item['url'],
            'content_hash' => $contentHash,
            'matched_keyword' => $matchedKeyword,
            'sentiment' => $analysis['sentiment'],
            'category' => $analysis['category'],
            'importance' => $analysis['importance'],
            'confidence_score' => $analysis['confidence_score'],
            'entity_confirmed' => $analysis['entity_confirmed'],
            'rejection_reason' => $analysis['reason'] ?? null,
            'published_at' => Carbon::parse($item['published_at']),
            'detected_at' => now(),
        ]);
    }

    /**
     * Trigger alert rules and log alerts.
     */
    public function triggerAlertRules(Mention $mention, MentionCluster $cluster): void
    {
        $activeRules = AlertRule::where('is_active', true)->get();

        foreach ($activeRules as $rule) {
            $isTriggered = false;
            $triggerMsg = "";

            switch ($rule->event_trigger) {
                case 'every_mention':
                    $isTriggered = true;
                    $triggerMsg = "New mention detected: '{$mention->title}'";
                    break;

                case 'high_importance':
                    $importanceConfig = $rule->trigger_conditions['importance'] ?? ['high', 'breaking'];
                    if (in_array(strtolower($mention->importance), $importanceConfig)) {
                        $isTriggered = true;
                        $triggerMsg = "High priority mention detected: '{$mention->title}' [Priority: " . strtoupper($mention->importance) . "]";
                    }
                    break;

                case 'negative_mixed_sentiment':
                    $sentimentConfig = $rule->trigger_conditions['sentiment'] ?? ['negative', 'mixed'];
                    if (in_array(strtolower($mention->sentiment), $sentimentConfig)) {
                        $isTriggered = true;
                        $triggerMsg = "Controversial or critical mention detected: '{$mention->title}' [Sentiment: " . strtoupper($mention->sentiment) . "]";
                    }
                    break;

                case 'trend':
                    $threshold = $rule->trigger_conditions['source_count'] ?? 5;
                    $mentionsInCluster = Mention::where('mention_cluster_id', $cluster->id)->count();
                    if ($mentionsInCluster >= $threshold) {
                        $isTriggered = true;
                        $triggerMsg = "Story cluster trending! Over {$threshold} sources are now covering: '{$cluster->title}'";
                    }
                    break;
            }

            if ($isTriggered) {
                $alert = Alert::create([
                    'alert_rule_id' => $rule->id,
                    'mention_id' => $mention->id,
                    'title' => $rule->name,
                    'message' => $triggerMsg,
                    'status' => 'unread',
                    'sent_at' => now(),
                ]);

                // Send email if channel is active
                if (in_array('email', $rule->channels)) {
                    $this->sendEmailAlert($alert, $mention);
                }
            }
        }
    }

    /**
     * Dispatch email notification.
     */
    private function sendEmailAlert(Alert $alert, Mention $mention)
    {
        $adminEmail = config('mail.from.address', 'admin@myprimetech.live');
        
        try {
            Mail::raw(
                "MEDIA ALERT SYSTEM - NEW INSTANT NOTIFICATION\n\n" .
                "Triggered Rule: {$alert->title}\n" .
                "Alert Message: {$alert->message}\n\n" .
                "Mention Details:\n" .
                "- Title: {$mention->title}\n" .
                "- Keyword Matched: {$mention->matched_keyword}\n" .
                "- Importance: " . strtoupper($mention->importance) . "\n" .
                "- Sentiment Assessment: " . strtoupper($mention->sentiment) . "\n" .
                "- Category: {$mention->category}\n" .
                "- Source Link: {$mention->url}\n\n" .
                "Please log in to your Media Intelligence Dashboard at myprimetech.live/admin/media-intelligence to review.",
                function ($message) use ($adminEmail, $alert) {
                    $message->to($adminEmail)
                        ->subject("[Media Alert] " . $alert->message);
                }
            );
        } catch (\Exception $e) {
            Log::error("Failed sending email alert: " . $e->getMessage());
        }
    }
}
