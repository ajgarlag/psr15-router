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
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class Route
{
    private $requestMatcher;
    private $requestHandler;

    /**
     * @param ServerRequestMatcher    $requestMatcher
     * @param RequestHandlerInterface $requestHandler
     */
    public function __construct(RequestMatcher $requestMatcher, RequestHandlerInterface $requestHandler)
    {
        $this->requestMatcher = $requestMatcher;
        $this->requestHandler = $requestHandler;
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
     * @return RequestHandlerInterface
     */
    public function getRequestHandler()
    {
        return $this->requestHandler;
    }
}
