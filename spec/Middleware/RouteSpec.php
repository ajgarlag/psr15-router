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
use Ajgarlag\Psr15\Router\Middleware\Route;
use Interop\Http\Server\MiddlewareInterface;
use PhpSpec\ObjectBehavior;

class RouteSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(
        RequestMatcher $requestMatcher,
        MiddlewareInterface $middleware
    ) {
        $this->beConstructedWith($requestMatcher, $middleware);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Route::class);
    }

    public function it_matches_request_through_request_matcher(RequestMatcher $requestMatcher)
    {
        $request = $this->fakeAServerRequest();
        $this->match($request);

        $requestMatcher->match($request)->shouldHaveBeenCalled();
    }

    public function it_has_a_middleware()
    {
        $this->getMiddleware()->shouldReturnAnInstanceOf(MiddlewareInterface::class);
    }
}
