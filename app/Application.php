<?php

namespace App;

use TrueFrame\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Call the given Closure / class method and inject its dependencies.
     *
     * Overrides the base container's call() to handle array callbacks
     * where the first element is already an object instance, and
     * Closures which should be invoked without an instance.
     *
     * @param callable|array $callback
     * @param array $parameters
     * @return mixed
     */
    public function call(callable|array $callback, array $parameters = []): mixed
    {
        if (is_string($callback) && str_contains($callback, '@')) {
            $callback = $this->createCallable($callback);
        }

        // Handle Closures and plain callables
        if ($callback instanceof \Closure || (is_string($callback) && function_exists($callback))) {
            $reflection = new \ReflectionFunction($callback);
            $dependencies = $this->resolveMethodDependencies($parameters, $reflection);
            return $reflection->invokeArgs($dependencies);
        }

        // Handle array callbacks: [object|class, method]
        if (is_array($callback)) {
            $reflection = new \ReflectionMethod($callback[0], $callback[1]);
            $dependencies = $this->resolveMethodDependencies($parameters, $reflection);

            $instance = is_object($callback[0])
                ? $callback[0]
                : $this->make($callback[0]);

            return $reflection->invokeArgs($instance, $dependencies);
        }

        // Fallback for other callables
        return call_user_func_array($callback, $parameters);
    }

    // Console output proxy methods — the framework's Command class
    // mistakenly resolves TrueFrame\Application instead of
    // TrueFrame\Console\Application for console output.

    public function info(string $message): void
    {
        echo "\033[32m" . $message . "\033[0m\n";
    }

    public function warn(string $message): void
    {
        echo "\033[33m" . $message . "\033[0m\n";
    }

    public function error(string $message): void
    {
        echo "\033[31m" . $message . "\033[0m\n";
    }

    public function line(string $message): void
    {
        echo $message . "\n";
    }
}
