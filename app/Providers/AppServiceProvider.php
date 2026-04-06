<?php

namespace App\Providers;

use TrueFrame\Support\ServiceProvider;
use TrueFrame\Exceptions\Handler;
use TrueFrame\Log\Logger as TFLogger;
use TrueFrame\Session\SessionManager;
use TrueFrame\Config\Repository as ConfigRepo;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 1) Logger — register under 'log' key (core alias maps Logger::class → 'log')
        $this->app->singleton('log', function ($app) {
            $config = $app->make(ConfigRepo::class);
            return new TFLogger($config);
        });

        // Allow resolving via PSR-3 LoggerInterface as well
        $this->app->alias('log', LoggerInterface::class);

        // 2) Exception handler
        $this->app->singleton(Handler::class, fn($app) => new Handler($app, $app->make('log')));
        $this->app->make(Handler::class)->register();

        // 3) Session — register under 'session' key (core alias maps SessionManager::class → 'session')
        $this->app->singleton('session', fn() => new SessionManager());
    }

    public function boot(): void {}
}
