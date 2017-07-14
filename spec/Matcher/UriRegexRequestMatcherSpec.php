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

use Ajgarlag\Psr15\Router\Matcher\UriRegexRequestMatcher;
use PhpSpec\ObjectBehavior;

class UriRegexRequestMatcherSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function let()
    {
        $this->beConstructedWith('^http://');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(UriRegexRequestMatcher::class);
    }

    public function it_matchs_request_if_uri_matchs_pattern()
    {
        $request = $this->fakeAServerRequest();
        $this->match($request)->shouldBe(true);
    }

    public function it_does_not_match_request_if_uri_does_not_match_pattern()
    {
        $this->beConstructedWith('^https://');
        $request = $this->fakeAServerRequest();
        $this->match($request)->shouldBe(false);
    }
}
