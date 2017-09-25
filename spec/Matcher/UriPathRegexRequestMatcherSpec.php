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

use Ajgarlag\Psr15\Router\Matcher\UriPathRegexRequestMatcher;
use PhpSpec\ObjectBehavior;

class UriPathRegexRequestMatcherSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function it_is_initializable()
    {
        $this->beConstructedWith('.*');
        $this->shouldHaveType(UriPathRegexRequestMatcher::class);
    }

    public function it_matches_request_if_path_pattern_matches()
    {
        $this->beConstructedWith('/(?:my)?account');
        $request = $this->fakeAServerRequest([], 'GET', 'http://example.org/account');
        $this->match($request)->shouldBe(true);
    }

    public function it_does_not_match_request_if_path_pattern_does_not_match()
    {
        $this->beConstructedWith('/(?:my)account');
        $request = $this->fakeAServerRequest([], 'GET', 'http://example.org/profile');
        $this->match($request)->shouldBe(false);
    }
}
