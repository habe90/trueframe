<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\AI\ScaffolderInterface;
use TrueFrame\AI\NullScaffolder;
use TrueFrame\Config\Repository;
use TrueFrame\Console\Application as ConsoleApplication;

class AIScaffolderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ScaffolderInterface::class, function ($app) {
            $scaffolderClass = $app->make(Repository::class)->get('ai.scaffolder', NullScaffolder::class);
            return $app->make($scaffolderClass); // Resolve the configured scaffolder
        });

        // Ensure NullScaffolder itself can be resolved if configured
        $this->app->bind(NullScaffolder::class, function ($app) {
            return new NullScaffolder($app, $app->make(ConsoleApplication::class));
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