<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Ajgarlag\Psr15\Router\Delegate;

use Ajgarlag\Psr15\Router\Delegate\Router;
use Ajgarlag\Psr15\Router\Delegate\RouterDelegate;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;

class RouterDelegateSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(
        Router $router,
        DelegateInterface $failoverDelegate
    ) {
        $this->beConstructedWith($router, $failoverDelegate);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RouterDelegate::class);
    }

    public function it_process_request_through_failover_delegate_if_no_route_match(
        Router $router,
        DelegateInterface $failoverDelegate
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn(null);

        $request = $this->fakeAServerRequest();
        $this->process($request);

        $failoverDelegate->process($request)->shouldHaveBeenCalled();
    }

    public function it_process_request_through_routed_delegate(
        Router $router,
        DelegateInterface $failoverDelegate,
        DelegateInterface $routedDelegate
    ) {
        $router->route(Argument::type(ServerRequestInterface::class))->willReturn($routedDelegate);

        $request = $this->fakeAServerRequest();
        $this->process($request);

        $failoverDelegate->process($request)->shouldNotHaveBeenCalled();
        $routedDelegate->process($request)->shouldHaveBeenCalled();
    }
}
