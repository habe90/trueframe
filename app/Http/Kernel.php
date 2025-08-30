<?php

namespace App\Http;

use TrueFrame\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<class-string<\TrueFrame\Http\Middleware\MiddlewareInterface>>
     */
    protected array $middleware = [
        // \App\Http\Middleware\TrustProxies::class, // Not implemented
        // \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // Not implemented
        // \App\Http\Middleware\StartSession::class, // Moved to groups
        // \App\Http\Middleware\CsrfMiddleware::class, // Moved to groups
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<class-string<\TrueFrame\Http\Middleware\MiddlewareInterface>>>
     */
    protected array $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\StartSession::class,
            \App\Http\Middleware\CsrfMiddleware::class,
            // \App\Http\Middleware\AddQueuedCookiesToResponse::class, // Not implemented
            // \App\Http\Middleware\EncryptCookies::class, // Not implemented
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // Not implemented
            // 'throttle:api', // Not implemented
            // \Illuminate\Routing\Middleware\SubstituteBindings::class, // Not implemented
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or individual routes.
     *
     * @var array<string, class-string<\TrueFrame\Http\Middleware\MiddlewareInterface>>
     */
    protected array $routeMiddleware = [
        'auth' => \App\Http\Middleware\AuthMiddleware::class,
        // 'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        // 'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        // 'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // 'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}