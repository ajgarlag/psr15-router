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
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ContainerRoute implements RouteInterface
{
    private RequestMatcher $requestMatcher;
    private ContainerInterface $container;
    private string $requestHandlerId;

    public function __construct(RequestMatcher $requestMatcher, ContainerInterface $container, string $requestHandlerId)
    {
        $this->requestMatcher = $requestMatcher;
        $this->container = $container;
        $this->requestHandlerId = $requestHandlerId;
    }

    public function match(ServerRequestInterface $request): bool
    {
        return $this->requestMatcher->match($request);
    }

    public function getRequestHandler(): RequestHandlerInterface
    {
        /** @var RequestHandlerInterface $requestHandler */
        $requestHandler = $this->container->get($this->requestHandlerId);

        return $requestHandler;
    }
}
