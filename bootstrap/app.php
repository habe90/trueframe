<?php

use App\Application;
use TrueFrame\Config\Repository;
use TrueFrame\Container\Container;
use TrueFrame\Support\Env;

// Create a new application instance
$app = new Application(
    realpath(__DIR__.'/../')
);

// Bind the container instance to itself
$app->singleton(Container::class, fn() => $app);

// Load environment variables
Env::load($app->basePath());

// Load configuration
// Register under 'config' key — core alias maps Repository::class → 'config'
$app->singleton('config', function () use ($app) {
    $config = new Repository();
    $appConfig = require $app->basePath('config/app.php');
    $config->set('app', $appConfig);
    $config->set('database', require $app->basePath('config/database.php'));
    $config->set('view', require $app->basePath('config/view.php'));
    $config->set('auth', require $app->basePath('config/auth.php'));
    // Expose ai config at top level so framework commands can find it
    if (isset($appConfig['ai'])) {
        $config->set('ai', $appConfig['ai']);
    }
    return $config;
});


// Register core service providers
$app->register(App\Providers\RouteServiceProvider::class);
$app->register(App\Providers\ViewServiceProvider::class);
$app->register(App\Providers\DatabaseServiceProvider::class);
$app->register(App\Providers\AIScaffolderServiceProvider::class);
$app->register(App\Providers\AppServiceProvider::class); // App specific providers last

// Boot the application (this calls the boot method on all registered providers)
$app->boot();

return $app;