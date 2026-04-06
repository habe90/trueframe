<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\View\View;
use TrueFrame\View\Compiler;
use App\View\Compiler as AppCompiler;
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
        // Use our AppCompiler which fixes the stopSection() bug
        $this->app->singleton(Compiler::class, function ($app) {
            return new AppCompiler($app->make(Repository::class));
        });

        // Register under 'view.factory' key — core alias maps View::class → 'view.factory'
        $this->app->singleton('view.factory', function ($app) {
            return new View(
                $app,
                $app->make(Repository::class),
                $app->make(Compiler::class)
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
        // The View constructor now handles setting the compiler on itself.
        // No need for a direct public property access here in boot.
    }
}