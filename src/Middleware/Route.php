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

use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

/**
 * @final
 */
class Route
{
    private RequestMatcher $requestMatcher;
    private MiddlewareInterface $middleware;

    public function __construct(RequestMatcher $requestMatcher, MiddlewareInterface $middleware)
    {
        $this->requestMatcher = $requestMatcher;
        $this->middleware = $middleware;
    }

    public function match(ServerRequestInterface $request): bool
    {
        return $this->requestMatcher->match($request);
    }

    public function getMiddleware(): MiddlewareInterface
    {
        return $this->middleware;
    }
}
