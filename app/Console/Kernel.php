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
        $console->add(new Commands\AiCrudCommand());
        $console->add(new Commands\AiControllerCommand());
        $console->add(new Commands\AiApiCommand());
        $console->add(new Commands\AiAuthCommand());
        $console->add(new Commands\AiAnalyzeCommand());
    }
}