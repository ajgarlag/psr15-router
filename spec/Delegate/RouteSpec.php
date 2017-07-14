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

use Ajgarlag\Psr15\Router\Delegate\Route;
use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PhpSpec\ObjectBehavior;

class RouteSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(
        RequestMatcher $requestMatcher,
        DelegateInterface $delegate
    ) {
        $this->beConstructedWith($requestMatcher, $delegate);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Route::class);
    }

    public function it_matchs_request_through_request_matcher(RequestMatcher $requestMatcher)
    {
        $request = $this->fakeAServerRequest();
        $this->match($request);

        $requestMatcher->match($request)->shouldHaveBeenCalled();
    }

    public function it_has_a_delegate()
    {
        $this->getDelegate()->shouldReturnAnInstanceOf(DelegateInterface::class);
    }
}
