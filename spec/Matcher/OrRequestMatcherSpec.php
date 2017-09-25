<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Ajgarlag\Psr15\Router\Matcher;

use Ajgarlag\Psr15\Router\Matcher\OrRequestMatcher;
use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use PhpSpec\ObjectBehavior;

class OrRequestMatcherSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(RequestMatcher $requestMatcher1, RequestMatcher $requestMatcher2)
    {
        $this->beConstructedWith($requestMatcher1, $requestMatcher2);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(OrRequestMatcher::class);
    }

    public function it_matches_request_if_any_of_inner_request_matchers_matches(RequestMatcher $requestMatcher1, RequestMatcher $requestMatcher2)
    {
        $request = $this->fakeAServerRequest();

        $requestMatcher1->match($request)->willReturn(false);
        $requestMatcher2->match($request)->willReturn(true);

        $this->match($request)->shouldBe(true);
    }

    public function it_does_not_match_request_if_inner_request_matchers_does_not_match(RequestMatcher $requestMatcher1, RequestMatcher $requestMatcher2)
    {
        $request = $this->fakeAServerRequest();

        $requestMatcher1->match($request)->willReturn(false);
        $requestMatcher2->match($request)->willReturn(false);

        $this->match($request)->shouldBe(false);
    }
}
