<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\Exceptions\Handler;
use TrueFrame\Log\Logger;
use TrueFrame\Session\SessionManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the Exception Handler
        $this->app->singleton(Handler::class, function ($app) {
            return new Handler($app, $app->make(Logger::class));
        });

        // Bind Logger
        $this->app->singleton(Logger::class, function ($app) {
            return new Logger($app->make(\TrueFrame\Config\Repository::class));
        });

        // Bind Session Manager
        $this->app->singleton(SessionManager::class, function ($app) {
            return new SessionManager();
        });
        $this->app->alias('session', SessionManager::class);

        // Register the exception handler
        $this->app->make(Handler::class)->register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}