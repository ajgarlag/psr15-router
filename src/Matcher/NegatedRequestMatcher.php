<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgarlag\Psr15\Router\Matcher;

class NegatedRequestMatcher
{
    private $requestMatcher;

    public function __construct(RequestMatcher $requestMatcher)
    {
        $this->requestMatcher = $requestMatcher;
    }

    public function match(\Psr\Http\Message\ServerRequestInterface $request)
    {
        return !$this->requestMatcher->match($request);
    }
}
