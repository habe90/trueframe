<?php

namespace App\Routing;

use TrueFrame\Application;
use TrueFrame\Routing\Router as BaseRouter;

class Router extends BaseRouter
{
    public function __construct(Application $app)
    {
        parent::__construct($app);

        // Replace the route collection with our fixed version
        $this->routes = new RouteCollection();
    }
}
