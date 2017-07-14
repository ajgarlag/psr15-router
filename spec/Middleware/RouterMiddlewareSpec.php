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
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;

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

    public function it_process_request_directly_through_delegate_if_no_route_match(
        Router $router,
        MiddlewareInterface $routedMiddleware,
        DelegateInterface $delegate
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn(null);

        $request = $this->fakeAServerRequest();
        $this->process($request, $delegate);

        $routedMiddleware->process($request, $delegate)->shouldNotHaveBeenCalled();
        $delegate->process($request)->shouldHaveBeenCalled();
    }

    public function it_process_request_through_routed_middleware(
        Router $router,
        MiddlewareInterface $routedMiddleware,
        DelegateInterface $delegate
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn($routedMiddleware);

        $request = $this->fakeAServerRequest();
        $this->process($request, $delegate);

        $routedMiddleware->process($request, $delegate)->shouldHaveBeenCalled();
        //$delegate->process($request)->shouldHaveBeenCalled();
    }
}
