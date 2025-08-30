<?php

return [
    'defaults' => [
        'guard' => 'web',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent', // Placeholder for future ORM integration
            'model' => App\Models\User::class, // Assume a User model will exist
        ],
    ],
];