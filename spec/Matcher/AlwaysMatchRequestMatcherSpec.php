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

use Ajgarlag\Psr15\Router\Matcher\AlwaysMatchRequestMatcher;
use PhpSpec\ObjectBehavior;

class AlwaysMatchRequestMatcherSpec extends ObjectBehavior
{
    use \spec\Ajgarlag\Psr15\Router\Psr7FactoryTrait;

    public function it_is_initializable()
    {
        $this->shouldHaveType(AlwaysMatchRequestMatcher::class);
    }

    public function it_matches_request()
    {
        $request = $this->fakeAServerRequest();
        $this->match($request)->shouldBe(true);
    }
}
