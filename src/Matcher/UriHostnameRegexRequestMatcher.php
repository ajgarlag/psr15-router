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

final class UriHostnameRegexRequestMatcher
{
    private string $pattern;

    public function __construct(string $pattern)
    {
        $this->pattern = '~'.str_replace('~', '\~', $pattern).'~i';
    }

    public function match(ServerRequestInterface $serverRequest): bool
    {
        return 1 === preg_match($this->pattern, $serverRequest->getUri()->getHost());
    }
}
