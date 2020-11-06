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

class Route
{
    private $requestMatcher;
    private $middleware;

    /**
     * @param ServerRequestMatcher $requestMatcher
     */
    public function __construct(RequestMatcher $requestMatcher, MiddlewareInterface $middleware)
    {
        $this->requestMatcher = $requestMatcher;
        $this->middleware = $middleware;
    }

    /**
     * @return bool
     */
    public function match(ServerRequestInterface $request)
    {
        return $this->requestMatcher->match($request);
    }

    /**
     * @return MiddlewareInterface
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }
}
