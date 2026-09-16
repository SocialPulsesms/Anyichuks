<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrackedKeyword;
use App\Models\Mention;
use App\Models\MentionSource;
use App\Models\MentionCluster;
use App\Models\MonitoringProvider;
use App\Models\MonitoringRun;
use App\Models\AlertRule;
use App\Models\Alert;
use App\Models\SentimentOverride;
use App\Services\MediaIntelligenceService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaIntelligenceController extends Controller
{
    protected $service;

    public function __construct(MediaIntelligenceService $service)
    {
        $this->service = $service;
    }

    /**
     * Helper to verify if admin is logged in.
     */
    private function checkAuth()
    {
        if (session('admin_logged_in') !== true) {
            abort(403, 'Unauthorized access.');
        }
    }

    /**
     * Render the Media Intelligence Analytics & Mentions Feed Dashboard.
     */
    public function dashboard(Request $request)
    {
        if (session('admin_logged_in') !== true) {
            return redirect('/contacts-login');
        }

        // --- FILTER PARAMETERS ---
        $dateFilter = $request->input('date_range', 'last_7_days');
        $sentimentFilter = $request->input('sentiment');
        $importanceFilter = $request->input('importance');
        $categoryFilter = $request->input('category');
        $keywordFilter = $request->input('keyword');
        $sourceFilter = $request->input('source');
        $searchQuery = $request->input('q');

        // Build base query
        // By default, only surface high-confidence and entity_confirmed matches
        // Allow looking at all matches by query parameter
        $showAll = $request->boolean('show_all', false);

        $query = Mention::with(['source', 'cluster', 'provider']);

        if (!$showAll) {
            $query->where('entity_confirmed', true);
        }

        // Apply Date Filters
        switch ($dateFilter) {
            case 'today':
                $query->whereDate('published_at', Carbon::today());
                break;
            case 'last_24_hours':
                $query->where('published_at', '>=', now()->subHours(24));
                break;
            case 'last_7_days':
                $query->where('published_at', '>=', now()->subDays(7));
                break;
            case 'last_30_days':
                $query->where('published_at', '>=', now()->subDays(30));
                break;
            case 'custom':
                if ($request->filled('start_date') && $request->filled('end_date')) {
                    $query->whereBetween('published_at', [
                        Carbon::parse($request->input('start_date'))->startOfDay(),
                        Carbon::parse($request->input('end_date'))->endOfDay(),
                    ]);
                }
                break;
        }

        // Apply dropdown filters
        if ($request->filled('sentiment')) {
            $query->where('sentiment', strtolower($sentimentFilter));
        }
        if ($request->filled('importance')) {
            $query->where('importance', strtolower($importanceFilter));
        }
        if ($request->filled('category')) {
            $query->where('category', $categoryFilter);
        }
        if ($request->filled('keyword')) {
            $query->where('matched_keyword', $keywordFilter);
        }
        if ($request->filled('source')) {
            $query->where('mention_source_id', $sourceFilter);
        }

        // Apply text search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%")
                  ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }

        // Execute queries for feed
        $mentions = $query->orderBy('published_at', 'desc')->paginate(12)->withQueryString();

        // --- STATS & CHARTS QUERIES (Filtered by the same date range for chart correlation) ---
        $statsQuery = Mention::query();
        if (!$showAll) {
            $statsQuery->where('entity_confirmed', true);
        }
        // Date scope stats
        switch ($dateFilter) {
            case 'today':
                $statsQuery->whereDate('published_at', Carbon::today());
                break;
            case 'last_24_hours':
                $statsQuery->where('published_at', '>=', now()->subHours(24));
                break;
            case 'last_7_days':
                $statsQuery->where('published_at', '>=', now()->subDays(7));
                break;
            case 'last_30_days':
                $statsQuery->where('published_at', '>=', now()->subDays(30));
                break;
        }

        $analyticsData = $statsQuery->get();

        // 1. Total Mentions counts
        $totalCount = $analyticsData->count();
        $positiveCount = $analyticsData->where('sentiment', 'positive')->count();
        $neutralCount = $analyticsData->where('sentiment', 'neutral')->count();
        $negativeCount = $analyticsData->where('sentiment', 'negative')->count();
        $mixedCount = $analyticsData->where('sentiment', 'mixed')->count();

        // 2. Mentions by Category
        $categoriesData = $analyticsData->groupBy('category')->map(fn($group) => $group->count());

        // 3. Top Keywords
        $keywordsData = $analyticsData->groupBy('matched_keyword')->map(fn($group) => $group->count())->sortDesc()->take(8);

        // 4. Mentions over time (grouped by day)
        $mentionsOverTime = $analyticsData->groupBy(function($item) {
            return Carbon::parse($item->published_at)->format('Y-m-d');
        })->map(fn($group) => [
            'total' => $group->count(),
            'positive' => $group->where('sentiment', 'positive')->count(),
            'negative' => $group->where('sentiment', 'negative')->count(),
            'neutral' => $group->where('sentiment', 'neutral')->count(),
            'mixed' => $group->where('sentiment', 'mixed')->count()
        ])->sortKeys();

        // 5. Mentions by Source
        $sourcesData = $analyticsData->groupBy('source.name')->map(fn($group) => $group->count())->sortDesc()->take(8);

        // Fetch list of filters options
        $allKeywords = TrackedKeyword::orderBy('keyword')->get();
        $allSources = MentionSource::orderBy('name')->get();
        
        // Fetch Story Clusters
        $storyClusters = MentionCluster::withCount('mentions')
            ->orderBy('last_updated_at', 'desc')
            ->take(10)
            ->get();

        // Unread Alerts
        $unreadAlerts = Alert::where('status', 'unread')->orderBy('created_at', 'desc')->take(10)->get();

        return view('media-intelligence', compact(
            'mentions',
            'totalCount',
            'positiveCount',
            'neutralCount',
            'negativeCount',
            'mixedCount',
            'categoriesData',
            'keywordsData',
            'mentionsOverTime',
            'sourcesData',
            'allKeywords',
            'allSources',
            'storyClusters',
            'unreadAlerts',
            'dateFilter'
        ));
    }

    /**
     * Render the Monitoring Health console.
     */
    public function health()
    {
        if (session('admin_logged_in') !== true) {
            return redirect('/contacts-login');
        }

        $providers = MonitoringProvider::withCount('mentions')->get();
        $recentRuns = MonitoringRun::with('provider')->orderBy('run_at', 'desc')->paginate(15);

        // Calculate global metrics
        $totalItemsFetched = MonitoringRun::sum('items_fetched');
        $totalItemsAccepted = MonitoringRun::sum('items_accepted');
        $totalItemsRejected = MonitoringRun::sum('items_rejected');

        $lastDatabaseWrite = Mention::orderBy('created_at', 'desc')->first()?->created_at?->toDateTimeString() ?? 'Never';

        return view('media-health', compact(
            'providers',
            'recentRuns',
            'totalItemsFetched',
            'totalItemsAccepted',
            'totalItemsRejected',
            'lastDatabaseWrite'
        ));
    }

    /**
     * Event stream (Server-Sent Events) for real-time dashboard updates.
     */
    public function stream(Request $request): StreamedResponse
    {
        // Allow CORS if needed, but since it's same-origin session-based auth is fine
        // Note: we can't write session easily inside stream loops in some setups, but we check first
        if (session('admin_logged_in') !== true) {
            abort(403);
        }

        $response = new StreamedResponse(function () {
            $lastCheckTime = now()->subSeconds(2);

            while (true) {
                // Check if connection is lost
                if (connection_aborted()) {
                    break;
                }

                // 1. Fetch any new mentions detected since last check
                $newMentions = Mention::with(['source', 'cluster'])
                    ->where('detected_at', '>', $lastCheckTime)
                    ->orderBy('published_at', 'desc')
                    ->get();

                if ($newMentions->isNotEmpty()) {
                    foreach ($newMentions as $mention) {
                        echo "event: mention\n";
                        echo "data: " . json_encode([
                            'id' => $mention->id,
                            'title' => $mention->title,
                            'description' => $mention->description,
                            'url' => $mention->url,
                            'matched_keyword' => $mention->matched_keyword,
                            'sentiment' => $mention->sentiment,
                            'category' => $mention->category,
                            'importance' => $mention->importance,
                            'confidence_score' => $mention->confidence_score,
                            'entity_confirmed' => $mention->entity_confirmed,
                            'published_at' => $mention->published_at->format('d M Y, h:i A'),
                            'source_name' => $mention->source->name,
                            'source_logo' => $mention->source->logo_url,
                        ]) . "\n\n";
                    }
                }

                // 2. Fetch new alerts trigger
                $newAlerts = Alert::where('created_at', '>', $lastCheckTime)
                    ->orderBy('created_at', 'desc')
                    ->get();

                if ($newAlerts->isNotEmpty()) {
                    foreach ($newAlerts as $alert) {
                        echo "event: alert\n";
                        echo "data: " . json_encode([
                            'id' => $alert->id,
                            'title' => $alert->title,
                            'message' => $alert->message,
                            'created_at' => $alert->created_at->format('h:i A'),
                        ]) . "\n\n";
                    }
                }

                $lastCheckTime = now();
                
                // Flush output buffers to stream data immediately
                if (ob_get_level() > 0) {
                    ob_flush();
                }
                flush();

                // Wait 2 seconds before querying database again
                sleep(2);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache, private');
        $response->headers->set('Connection', 'keep-alive');
        $response->headers->set('X-Accel-Buffering', 'no'); // Disable Nginx buffer output

        return $response;
    }

    /**
     * Perform immediate manual synchronization scan of enabled providers.
     */
    public function runScanNow()
    {
        $this->checkAuth();

        $providers = MonitoringProvider::where('is_enabled', true)->get();
        $totalFetched = 0;
        $totalAccepted = 0;
        $totalRejected = 0;

        foreach ($providers as $provider) {
            $result = $this->service->syncProvider($provider);
            if (($result['status'] ?? '') === 'success') {
                $totalFetched += $result['fetched'];
                $totalAccepted += $result['accepted'];
                $totalRejected += $result['rejected'];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Scan completed successfully.',
            'fetched' => $totalFetched,
            'accepted' => $totalAccepted,
            'rejected' => $totalRejected
        ]);
    }

    /**
     * Override automatic sentiment classification.
     */
    public function overrideSentiment(Request $request, $id)
    {
        $this->checkAuth();

        $validator = Validator::make($request->all(), [
            'sentiment' => 'required|in:positive,neutral,negative,mixed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid sentiment value.'], 422);
        }

        $mention = Mention::findOrFail($id);
        $oldSentiment = $mention->sentiment;
        $newSentiment = $request->input('sentiment');

        if ($oldSentiment !== $newSentiment) {
            // Update mention record
            $mention->sentiment = $newSentiment;
            $mention->save();

            // Record override history log
            SentimentOverride::updateOrCreate(
                ['mention_id' => $mention->id],
                [
                    'old_sentiment' => $oldSentiment,
                    'new_sentiment' => $newSentiment,
                    'overridden_by' => 'Administrator',
                    'overridden_at' => now(),
                ]
            );
        }

        return response()->json(['success' => true, 'sentiment' => $newSentiment]);
    }

    /**
     * CRUD and actions for monitored Keywords.
     */
    public function manageKeywords(Request $request)
    {
        $this->checkAuth();

        $action = $request->input('action');

        if ($action === 'create') {
            $validator = Validator::make($request->all(), [
                'keyword' => 'required|string|unique:tracked_keywords|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $kw = TrackedKeyword::create([
                'keyword' => $request->input('keyword'),
                'is_active' => true,
            ]);

            return response()->json(['success' => true, 'data' => $kw]);
        }

        if ($action === 'toggle') {
            $id = $request->input('id');
            $kw = TrackedKeyword::findOrFail($id);
            $kw->is_active = !$kw->is_active;
            $kw->save();

            return response()->json(['success' => true, 'is_active' => $kw->is_active]);
        }

        if ($action === 'delete') {
            $id = $request->input('id');
            $kw = TrackedKeyword::findOrFail($id);
            $kw->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Invalid action.'], 400);
    }

    /**
     * CRUD and toggle switches for Providers.
     */
    public function manageProviders(Request $request, $id)
    {
        $this->checkAuth();

        $provider = MonitoringProvider::findOrFail($id);
        $action = $request->input('action');

        if ($action === 'toggle') {
            $provider->is_enabled = !$provider->is_enabled;
            $provider->save();

            return response()->json(['success' => true, 'is_enabled' => $provider->is_enabled]);
        }

        if ($action === 'update') {
            $validator = Validator::make($request->all(), [
                'polling_interval' => 'required|integer|min:60',
                'api_config' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $provider->polling_interval = $request->input('polling_interval');
            if ($request->has('api_config')) {
                $provider->api_config = array_merge($provider->api_config ?? [], $request->input('api_config'));
            }
            $provider->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Invalid action.'], 400);
    }

    /**
     * Alert rules updates.
     */
    public function manageAlertRules(Request $request)
    {
        $this->checkAuth();

        $action = $request->input('action');

        if ($action === 'toggle') {
            $id = $request->input('id');
            $rule = AlertRule::findOrFail($id);
            $rule->is_active = !$rule->is_active;
            $rule->save();

            return response()->json(['success' => true, 'is_active' => $rule->is_active]);
        }

        return response()->json(['error' => 'Invalid action.'], 400);
    }

    /**
     * Dismiss all recent alerts.
     */
    public function dismissAlerts()
    {
        $this->checkAuth();

        Alert::where('status', 'unread')->update(['status' => 'read']);

        return response()->json(['success' => true]);
    }
}
