<?php

namespace App\Console;

use TrueFrame\Application;
use TrueFrame\Console\Application as ConsoleApplication;

class Kernel
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Create a new console kernel instance.
     *
     * @param Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Register the commands for the application.
     *
     * @param ConsoleApplication $console
     * @return void
     */
    public function registerCommands(ConsoleApplication $console): void
    {
        // Register your application-specific console commands here
        // Example: $console->add(new \App\Console\Commands\MyCustomCommand());
    }
}