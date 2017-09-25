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

use Ajgarlag\Psr15\Router\Matcher\MethodRequestMatcher;
use PhpSpec\ObjectBehavior;

class MethodRequestMatcherSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function it_is_initializable()
    {
        $this->beConstructedWith('GET');
        $this->shouldHaveType(MethodRequestMatcher::class);
    }

    public function it_matches_request_if_methods_param_matches()
    {
        $this->beConstructedWith(['GET', 'POST']);
        $request = $this->fakeAServerRequest([], 'GET');
        $this->match($request)->shouldBe(true);
    }

    public function it_does_not_match_request_if_methods_param_does_not_match()
    {
        $this->beConstructedWith('PUT');
        $request = $this->fakeAServerRequest([], 'POST');
        $this->match($request)->shouldBe(false);
    }
}
