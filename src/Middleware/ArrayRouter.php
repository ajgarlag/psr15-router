<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgarlag\Psr15\Router\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

final class ArrayRouter implements RouteCollectionRouter
{
    /**
     * @var RouteInterface[]
     */
    private $routes = [];

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function addRoute(RouteInterface $route): void
    {
        $this->routes[spl_object_id($route)] = $route;
    }

    public function removeRoute(RouteInterface $route): void
    {
        unset($this->routes[spl_object_id($route)]);
    }

    public function route(ServerRequestInterface $request): ?MiddlewareInterface
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route->getMiddleware();
            }
        }

        return null;
    }
}
