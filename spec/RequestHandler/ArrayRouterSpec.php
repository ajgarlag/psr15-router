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

use Ajgarlag\Psr15\Router\RequestHandler\ArrayRouter;
use Ajgarlag\Psr15\Router\RequestHandler\Route;
use Interop\Http\Server\RequestHandlerInterface;
use PhpSpec\ObjectBehavior;

class ArrayRouterSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function it_is_initializable()
    {
        $this->shouldHaveType(ArrayRouter::class);
    }

    public function it_has_an_array_of_routes()
    {
        $this->getRoutes()->shouldBeArray();
    }

    public function it_can_have_added_routes(
        Route $route1,
        Route $route2
    ) {
        $this->addRoute($route1);
        $this->getRoutes()->shouldHaveCount(1);
        $this->getRoutes()->shouldContain($route1);

        $this->addRoute($route2);
        $this->getRoutes()->shouldHaveCount(2);
        $this->getRoutes()->shouldContain($route2);
    }

    public function it_can_remove_added_routes(
        Route $route1
    ) {
        $this->addRoute($route1);
        $this->getRoutes()->shouldContain($route1);

        $this->removeRoute($route1);
        $this->getRoutes()->shouldNotContain($route1);
    }

    public function it_returns_matched_route_request_handler(
        Route $route1,
        Route $route2,
        RequestHandlerInterface $routedRequestHandler
    ) {
        $request = $this->fakeAServerRequest();

        $route1->match($request)->willReturn(false);
        $route2->match($request)->willReturn(true);
        $route2->getRequestHandler()->willReturn($routedRequestHandler);

        $this->addRoute($route1);
        $this->addRoute($route2);

        $this->route($request)->shouldReturn($routedRequestHandler);
    }

    public function it_returns_null_if_no_matched_route(
        Route $route1,
        Route $route2
    ) {
        $request = $this->fakeAServerRequest();

        $route1->match($request)->willReturn(false);
        $route2->match($request)->willReturn(false);

        $this->addRoute($route1);
        $this->addRoute($route2);

        $this->route($request)->shouldReturn(null);
    }
}
