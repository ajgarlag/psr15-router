<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Ajgarlag\Psr15\Router\RequestHandler;

use Ajgarlag\Psr15\Router\RequestHandler\Router;
use Ajgarlag\Psr15\Router\RequestHandler\RouterRequestHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterRequestHandlerSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(
        Router $router,
        RequestHandlerInterface $failoverRequestHandler
    ) {
        $this->beConstructedWith($router, $failoverRequestHandler);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RouterRequestHandler::class);
    }

    public function it_process_request_through_failover_request_handler_if_no_route_match(
        Router $router,
        RequestHandlerInterface $failoverRequestHandler
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn(null);
        $failoverRequestHandler->handle(Argument::type(ServerRequestInterface::class))->willReturn($this->fakeAResponse());

        $request = $this->fakeAServerRequest();
        $this->handle($request);

        $failoverRequestHandler->handle($request)->shouldHaveBeenCalled();
    }

    public function it_process_request_through_routed_request_handler(
        Router $router,
        RequestHandlerInterface $failoverRequestHandler,
        RequestHandlerInterface $routedRequestHandler
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn($routedRequestHandler);
        $routedRequestHandler->handle(Argument::type(ServerRequestInterface::class))->willReturn($this->fakeAResponse());

        $request = $this->fakeAServerRequest();
        $this->handle($request);

        $failoverRequestHandler->handle($request)->shouldNotHaveBeenCalled();
        $routedRequestHandler->handle($request)->shouldHaveBeenCalled();
    }
}
