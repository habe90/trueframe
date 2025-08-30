<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\View\View;
use TrueFrame\View\Compiler;
use TrueFrame\Config\Repository;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Compiler::class, function ($app) {
            return new Compiler($app->make(Repository::class));
        });

        $this->app->singleton(View::class, function ($app) {
            return new View(
                $app,
                $app->make(Repository::class),
                $app->make(Compiler::class)
            );
        });
        $this->app->alias('view.factory', View::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // The View constructor now handles setting the compiler on itself.
        // No need for a direct public property access here in boot.
    }
}