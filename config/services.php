<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'gemini' => [
        'key' => (function() {
            if (file_exists(base_path('.env'))) {
                $lines = file(base_path('.env'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (str_starts_with(trim($line), 'GEMINI_API_KEY=')) {
                        $parts = explode('=', $line, 2);
                        return trim($parts[1] ?? '', "\"' ");
                    }
                }
            }
            return env('GEMINI_API_KEY');
        })(),
    ],

    'admin' => [
        'password' => (function() {
            if (file_exists(base_path('.env'))) {
                $lines = file(base_path('.env'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (str_starts_with(trim($line), 'ADMIN_PASSWORD=')) {
                        $parts = explode('=', $line, 2);
                        return trim($parts[1] ?? '', "\"' ");
                    }
                }
            }
            return env('ADMIN_PASSWORD', 'anyichuks2026');
        })(),
    ],

    'media' => [
        'gemini_key' => env('MONITORING_AI_API_KEY'),
        'news_key' => env('NEWS_PROVIDER_API_KEY'),
        'youtube_key' => env('YOUTUBE_API_KEY'),
        'twitter_token' => env('TWITTER_BEARER_TOKEN'),
        'facebook_token' => env('FACEBOOK_ACCESS_TOKEN'),
        'instagram_token' => env('INSTAGRAM_ACCESS_TOKEN'),
        'instagram_user_id' => env('INSTAGRAM_USER_ID'),
        'tiktok_token' => env('TIKTOK_ACCESS_TOKEN'),
    ],

];
