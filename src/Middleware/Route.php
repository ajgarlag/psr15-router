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
use Interop\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

class Route
{
    private $requestMatcher;
    private $middleware;

    /**
     * @param ServerRequestMatcher $requestMatcher
     * @param MiddlewareInterface  $middleware
     */
    public function __construct(RequestMatcher $requestMatcher, MiddlewareInterface $middleware)
    {
        $this->requestMatcher = $requestMatcher;
        $this->middleware = $middleware;
    }

    /**
     * @param ServerRequestInterface $request
     *
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
