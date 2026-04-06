<?php

namespace App\Routing;

use TrueFrame\Routing\RouteCollection as BaseRouteCollection;

class RouteCollection extends BaseRouteCollection
{
    /**
     * Find the first route matching a given request.
     *
     * Fixes the base class bug where trim($uri, '/') removes the leading
     * slash but Route::getRegex() always prepends one, so no routes match.
     *
     * @param string $method
     * @param string $uri
     * @return \TrueFrame\Routing\Route|null
     */
    public function match(string $method, string $uri): ?\TrueFrame\Routing\Route
    {
        // Normalize: always have a leading slash, no trailing slash
        $uri = '/' . trim($uri, '/');

        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route->getRegex(), $uri, $matches)) {
                $parameters = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $route->setParameters($parameters);
            }
        }

        return null;
    }
}
