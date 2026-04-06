<?php

namespace App;

use TrueFrame\Application as BaseApplication;

class Application extends BaseApplication
{
    // Console output proxy methods — the framework's Command class
    // resolves TrueFrame\Application instead of
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
