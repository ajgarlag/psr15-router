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

use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @final
 */
class Route
{
    private RequestMatcher $requestMatcher;
    private RequestHandlerInterface $requestHandler;

    public function __construct(RequestMatcher $requestMatcher, RequestHandlerInterface $requestHandler)
    {
        $this->requestMatcher = $requestMatcher;
        $this->requestHandler = $requestHandler;
    }

    public function match(ServerRequestInterface $request): bool
    {
        return $this->requestMatcher->match($request);
    }

    public function getRequestHandler(): RequestHandlerInterface
    {
        return $this->requestHandler;
    }
}
