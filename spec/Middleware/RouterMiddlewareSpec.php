<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Ajgarlag\Psr15\Router\Middleware;

use Ajgarlag\Psr15\Router\Middleware\Router;
use Ajgarlag\Psr15\Router\Middleware\RouterMiddleware;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterMiddlewareSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(
        Router $router
    ) {
        $this->beConstructedWith($router);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RouterMiddleware::class);
    }

    public function it_process_request_directly_through_request_handler_if_no_route_match(
        Router $router,
        MiddlewareInterface $routedMiddleware,
        RequestHandlerInterface $requestHandler
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn(null);
        $requestHandler->handle(Argument::type(ServerRequestInterface::class))->willReturn($this->fakeAResponse());

        $request = $this->fakeAServerRequest();
        $this->process($request, $requestHandler);

        $routedMiddleware->process($request, $requestHandler)->shouldNotHaveBeenCalled();
        $requestHandler->handle($request)->shouldHaveBeenCalled();
    }

    public function it_process_request_through_routed_middleware(
        Router $router,
        MiddlewareInterface $routedMiddleware,
        RequestHandlerInterface $requestHandler
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn($routedMiddleware);
        $routedMiddleware->process(Argument::type(ServerRequestInterface::class), Argument::type(RequestHandlerInterface::class))
            ->will(function ($args) { return $args[1]->handle($args[0]); });
        $requestHandler->handle(Argument::type(ServerRequestInterface::class))->willReturn($this->fakeAResponse());

        $request = $this->fakeAServerRequest();
        $this->process($request, $requestHandler);

        $routedMiddleware->process($request, $requestHandler)->shouldHaveBeenCalled();
        $requestHandler->handle($request)->shouldHaveBeenCalled();
    }
}
