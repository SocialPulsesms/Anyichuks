<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrackedKeyword;
use App\Models\MonitoringProvider;
use App\Models\AlertRule;

class MediaIntelligenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Tracked Keywords
        $keywords = [
            'Ifeanyichukwu Odii',
            'Ifeanyi Odii',
            'Ifeanyi Chukwuma Odii',
            'Ifeanyi-Chukwuma Odii',
            'Chief Ifeanyi Odii',
            'Dr Ifeanyichukwu Odii',
            'Anyichuks',
            'AnyiChuks',
            'Anyi Chuks',
            'ANYICHUKS',
            'Anyi Ga Emeya',
            'PDP candidate Ebonyi State',
            'PDP governorship candidate Ebonyi',
            'Ebonyi PDP candidate',
            'Ebonyi 2027 PDP candidate',
        ];

        foreach ($keywords as $keyword) {
            TrackedKeyword::firstOrCreate(['keyword' => $keyword], ['is_active' => true]);
        }

        // 2. Seed Providers
        $providers = [
            [
                'name' => 'Google News',
                'type' => 'google_news',
                'api_config' => [],
                'polling_interval' => 900, // 15 mins
                'is_enabled' => true,
            ],
            [
                'name' => 'Bluesky Search',
                'type' => 'social',
                'api_config' => [],
                'polling_interval' => 900, // 15 mins
                'is_enabled' => true,
            ],
            [
                'name' => 'Publisher RSS Feeds',
                'type' => 'rss',
                'api_config' => [
                    'feeds' => [
                        'https://www.vanguardngr.com/feed/',
                        'https://punchng.com/feed/',
                        'https://guardian.ng/feed/',
                        'https://sunnewsonline.com/feed/'
                    ]
                ],
                'polling_interval' => 1800, // 30 mins
                'is_enabled' => true,
            ],
            [
                'name' => 'NewsAPI.org',
                'type' => 'newsapi',
                'api_config' => [
                    'api_key' => null, // Configured from env in runtime
                ],
                'polling_interval' => 3600, // 1 hour
                'is_enabled' => true,
            ],
            [
                'name' => 'YouTube Search',
                'type' => 'youtube',
                'api_config' => [
                    'api_key' => null, // Configured from env in runtime
                ],
                'polling_interval' => 3600, // 1 hour
                'is_enabled' => true,
            ],
            [
                'name' => 'Twitter (X)',
                'type' => 'social',
                'api_config' => [],
                'polling_interval' => 900,
                'is_enabled' => true,
            ],
            [
                'name' => 'Facebook Search',
                'type' => 'social',
                'api_config' => [],
                'polling_interval' => 1800,
                'is_enabled' => true,
            ],
            [
                'name' => 'Instagram Hashtag Search',
                'type' => 'social',
                'api_config' => [],
                'polling_interval' => 1800,
                'is_enabled' => true,
            ],
            [
                'name' => 'TikTok Search',
                'type' => 'social',
                'api_config' => [],
                'polling_interval' => 1800,
                'is_enabled' => true,
            ],
        ];

        foreach ($providers as $provider) {
            MonitoringProvider::firstOrCreate(['name' => $provider['name']], $provider);
        }

        // 3. Seed Alert Rules
        $rules = [
            [
                'name' => 'Alert for every mention',
                'event_trigger' => 'every_mention',
                'trigger_conditions' => [],
                'channels' => ['in_app'],
                'is_active' => true,
            ],
            [
                'name' => 'Alert for High/Breaking Importance',
                'event_trigger' => 'high_importance',
                'trigger_conditions' => [
                    'importance' => ['high', 'breaking']
                ],
                'channels' => ['in_app', 'email'],
                'is_active' => true,
            ],
            [
                'name' => 'Alert for Negative/Mixed Sentiment',
                'event_trigger' => 'negative_mixed_sentiment',
                'trigger_conditions' => [
                    'sentiment' => ['negative', 'mixed']
                ],
                'channels' => ['in_app', 'email'],
                'is_active' => true,
            ],
            [
                'name' => 'Alert for Trending Mentions',
                'event_trigger' => 'trend',
                'trigger_conditions' => [
                    'source_count' => 5 // discuss the same story (cluster count)
                ],
                'channels' => ['in_app'],
                'is_active' => true,
            ],
        ];

        foreach ($rules as $rule) {
            AlertRule::firstOrCreate(['name' => $rule['name']], $rule);
        }
    }
}
