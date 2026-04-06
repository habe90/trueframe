<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\Routing\Router;
use App\Routing\Router as AppRouter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string|null
     */
    protected ?string $namespace = 'App\\Controllers';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register under 'router' key — core alias maps Router::class → 'router'
        // Use our AppRouter which fixes the route matching bug
        $this->app->singleton('router', function ($app) {
            return new AppRouter($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mapRoutes();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function mapRoutes(): void
    {
        $router = $this->app->make(Router::class);

        // Load web routes
        $router->group(['namespace' => $this->namespace, 'middleware' => 'web'], function () {
            require $this->app->basePath('routes/web.php');
        });

        // Load API routes
        $router->group(['namespace' => $this->namespace, 'middleware' => 'api', 'prefix' => 'api'], function () {
            require $this->app->basePath('routes/api.php');
        });
    }
}