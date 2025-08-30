<?php

namespace App\Providers;

use TrueFrame\Application;
use TrueFrame\Support\ServiceProvider;
use TrueFrame\Routing\Router;

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
        $this->app->singleton(Router::class, function ($app) {
            return new Router($app);
        });
        $this->app->alias('router', Router::class);
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