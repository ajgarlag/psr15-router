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

interface RouteCollectionRouter extends Router
{
    /**
     * @param Route $route
     */
    public function addRoute(Route $route);

    /**
     * @param Route $route
     */
    public function removeRoute(Route $route);

    /**
     * @return Route[]
     */
    public function getRoutes();
}
