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
        // 1) Registruj Logger
        $this->app->singleton(TFLogger::class, function ($app) {
            /** @var ConfigRepo $config */
            $config = $app->make(ConfigRepo::class);
            return new TFLogger($config);
        });

        // 2) Alias-i na PSR-3 i string 'log'
        $this->app->alias(TFLogger::class, LoggerInterface::class);
        $this->app->alias(TFLogger::class, 'log');
        $this->app->singleton('log', fn($app) => $app->make(TFLogger::class));

        // 3) Exception handler koji koristi logger iz kontejnera
        $this->app->singleton(Handler::class, fn($app) => new Handler($app, $app->make(TFLogger::class)));
        $this->app->make(Handler::class)->register();

        // 4) Session
        $this->app->singleton(SessionManager::class, fn() => new SessionManager());
        $this->app->alias('session', SessionManager::class);
    }

    public function boot(): void {}
}
