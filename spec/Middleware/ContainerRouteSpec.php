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

use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use Ajgarlag\Psr15\Router\Middleware\ContainerRoute;
use PhpSpec\ObjectBehavior;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;

class ContainerRouteSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(
        RequestMatcher $requestMatcher,
        ContainerInterface $container
    ) {
        $this->beConstructedWith($requestMatcher, $container, 'foobar');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ContainerRoute::class);
    }

    public function it_matches_request_through_request_matcher(RequestMatcher $requestMatcher)
    {
        $request = $this->fakeAServerRequest();
        $requestMatcher->match($request)->willReturn(false)->shouldBeCalled();

        $this->match($request);
    }

    public function it_get_a_middleware_from_container(ContainerInterface $container, MiddlewareInterface $middleware)
    {
        $container->get('foobar')->willReturn($middleware);

        $this->getMiddleware()->shouldReturnAnInstanceOf(MiddlewareInterface::class);
    }
}
