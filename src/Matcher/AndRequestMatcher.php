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

use Psr\Http\Message\ServerRequestInterface;

final class AndRequestMatcher implements RequestMatcher
{
    private RequestMatcher $firstRequestMatcher;
    private RequestMatcher $lastRequestMatcher;

    public function __construct(RequestMatcher $firstRequestMatcher, RequestMatcher $lastRequestMatcher)
    {
        $this->firstRequestMatcher = $firstRequestMatcher;
        $this->lastRequestMatcher = $lastRequestMatcher;
    }

    public function match(ServerRequestInterface $request): bool
    {
        return $this->firstRequestMatcher->match($request)
            && $this->lastRequestMatcher->match($request);
    }
}
