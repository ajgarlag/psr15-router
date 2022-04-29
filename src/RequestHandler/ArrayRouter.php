<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgarlag\Psr15\Router\RequestHandler;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ArrayRouter implements RouteCollectionRouter
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function addRoute(Route $route): void
    {
        $this->routes[spl_object_id($route)] = $route;
    }

    public function removeRoute(Route $route): void
    {
        unset($this->routes[spl_object_id($route)]);
    }

    public function route(ServerRequestInterface $request): ?RequestHandlerInterface
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route->getRequestHandler();
            }
        }

        return null;
    }
}
