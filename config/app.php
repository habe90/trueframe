<?php

return [
    'name' => env('APP_NAME', 'TrueFrame'),
    'env' => env('APP_ENV', 'local'),
    'debug' => (bool) env('APP_DEBUG', true),
    'url' => env('APP_URL', 'http://localhost'),
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC', // Not implemented yet, but good to have

    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',

    'log_channel' => env('LOG_CHANNEL', 'daily'),
    'log_path' => env('LOG_PATH', storage_path('logs/trueframe.log')),

    'ai' => [
        'scaffolder' => TrueFrame\AI\NullScaffolder::class, // Or any other AI scaffolder
    ],
];