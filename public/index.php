<?php

/**
 * TrueFrame - A lightweight, Laravel-like PHP framework.
 *
 * @author Architect AI
 */

// Autoload Composer dependencies
require __DIR__.'/../vendor/autoload.php';

// Load the application instance
$app = require_once __DIR__.'/../bootstrap/app.php';

// Resolve the HTTP kernel and handle the request
$kernel = $app->make(App\Http\Kernel::class);

$request = TrueFrame\Http\Request::capture();

try {
    $response = $kernel->handle($request);
} catch (Throwable $e) {
    // Catch any uncaught exceptions and let the handler deal with them
    $handler = $app->make(TrueFrame\Exceptions\Handler::class);
    $response = $handler->render($request, $e);
}

// Send the response to the browser
$response->send();

// Terminate the request lifecycle
$kernel->terminate($request, $response);