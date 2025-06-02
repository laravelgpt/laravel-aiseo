<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Prism API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Prism API settings for AI-powered SEO analysis.
    |
    */

    'api_key' => env('PRISM_API_KEY'),

    'api_url' => env('PRISM_API_URL', 'https://api.prism.ai'),

    'timeout' => env('PRISM_TIMEOUT', 30),

    'retry_attempts' => env('PRISM_RETRY_ATTEMPTS', 3),

    'cache' => [
        'enabled' => env('PRISM_CACHE_ENABLED', true),
        'ttl' => env('PRISM_CACHE_TTL', 3600), // 1 hour
    ],

    'models' => [
        'default' => env('PRISM_DEFAULT_MODEL', 'gpt-4'),
        'available' => [
            'gpt-4' => [
                'name' => 'GPT-4',
                'max_tokens' => 8192,
            ],
            'gpt-3.5-turbo' => [
                'name' => 'GPT-3.5 Turbo',
                'max_tokens' => 4096,
            ],
        ],
    ],

    'features' => [
        'content_analysis' => true,
        'keyword_suggestions' => true,
        'seo_optimization' => true,
        'competitor_analysis' => true,
    ],
]; 