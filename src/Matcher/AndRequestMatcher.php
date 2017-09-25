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

class AndRequestMatcher implements RequestMatcher
{
    private $firstRequestMatcher;
    private $lastRequestMatcher;

    public function __construct(RequestMatcher $firstRequestMatcher, RequestMatcher $lastRequestMatcher)
    {
        $this->firstRequestMatcher = $firstRequestMatcher;
        $this->lastRequestMatcher = $lastRequestMatcher;
    }

    public function match(\Psr\Http\Message\ServerRequestInterface $request)
    {
        return $this->firstRequestMatcher->match($request)
            && $this->lastRequestMatcher->match($request);
    }
}
