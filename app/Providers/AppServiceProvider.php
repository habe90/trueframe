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
        // Logger (glavni binding)
        $this->app->singleton(TFLogger::class, function ($app) {
            /** @var ConfigRepo $config */
            $config = $app->make(ConfigRepo::class);
            return new TFLogger($config);
        });

        // PSR-3 alias i string aliasi (pokrij sve slučajeve)
        $this->app->alias(TFLogger::class, LoggerInterface::class);
        $this->app->alias(TFLogger::class, 'log');

        // Exception handler koristi logger iz kontejnera
        $this->app->singleton(Handler::class, function ($app) {
            return new Handler($app, $app->make(TFLogger::class));
        });

        // Session
        $this->app->singleton(SessionManager::class, fn() => new SessionManager());
        $this->app->alias('session', SessionManager::class);

        // Registruj globalni handler
        $this->app->make(Handler::class)->register();
    }

    public function boot(): void
    {
        //
    }
}
