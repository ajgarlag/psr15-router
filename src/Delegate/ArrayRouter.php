<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgarlag\Psr15\Router\Delegate;

use Psr\Http\Message\ServerRequestInterface;

class ArrayRouter implements RouteCollectionRouter
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function getRoutes()
    {
        return $this->routes;
    }

    public function addRoute(Route $route)
    {
        $this->routes[spl_object_hash($route)] = $route;
    }

    public function removeRoute(Route $route)
    {
        unset($this->routes[spl_object_hash($route)]);
    }

    public function route(ServerRequestInterface $request)
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route->getDelegate();
            }
        }
    }
}
