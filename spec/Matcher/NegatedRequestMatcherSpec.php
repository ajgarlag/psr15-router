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

use Ajgarlag\Psr15\Router\Matcher\NegatedRequestMatcher;
use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use PhpSpec\ObjectBehavior;

class NegatedRequestMatcherSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let(RequestMatcher $requestMatcher)
    {
        $this->beConstructedWith($requestMatcher);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(NegatedRequestMatcher::class);
    }

    public function it_matches_request_if_inner_request_matcher_does_not_match(RequestMatcher $requestMatcher)
    {
        $request = $this->fakeAServerRequest();

        $requestMatcher->match($request)->willReturn(false);

        $this->match($request)->shouldBe(true);
    }

    public function it_does_not_match_request_if_inner_request_matcher_matches(RequestMatcher $requestMatcher)
    {
        $request = $this->fakeAServerRequest();

        $requestMatcher->match($request)->willReturn(true);

        $this->match($request)->shouldBe(false);
    }
}
