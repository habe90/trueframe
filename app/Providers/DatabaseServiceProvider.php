<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\Database\Connection;
use TrueFrame\Database\Migrations\Migrator;
use TrueFrame\Database\Migrations\MigrationRepository;
use TrueFrame\Config\Repository;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Connection::class, function ($app) {
            return new Connection($app->make(Repository::class));
        });

        $this->app->singleton(MigrationRepository::class, function ($app) {
            return new MigrationRepository($app->make(Connection::class));
        });

        $this->app->singleton(Migrator::class, function ($app) {
            return new Migrator(
                $app,
                $app->make(Connection::class),
                $app->make(MigrationRepository::class)
            );
        });
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