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
    public function addRoute(RouteInterface $route): void;

    public function removeRoute(RouteInterface $route): void;

    /**
     * @return RouteInterface[]
     */
    public function getRoutes(): array;
}
