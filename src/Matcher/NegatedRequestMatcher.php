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

final class NegatedRequestMatcher
{
    private RequestMatcher $requestMatcher;

    public function __construct(RequestMatcher $requestMatcher)
    {
        $this->requestMatcher = $requestMatcher;
    }

    public function match(ServerRequestInterface $request): bool
    {
        return !$this->requestMatcher->match($request);
    }
}
