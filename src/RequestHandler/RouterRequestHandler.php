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

use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterRequestHandler implements RequestHandlerInterface
{
    private $router;
    private $failoverRequestHandler;

    public function __construct(Router $router, RequestHandlerInterface $failoverRequestHandler)
    {
        $this->router = $router;
        $this->failoverRequestHandler = $failoverRequestHandler;
    }

    public function handle(ServerRequestInterface $request)
    {
        if (null === $requestHandler = $this->router->route($request)) {
            return $this->failoverRequestHandler->handle($request);
        }

        return $requestHandler->handle($request);
    }
}