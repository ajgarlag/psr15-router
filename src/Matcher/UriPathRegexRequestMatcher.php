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

class UriPathRegexRequestMatcher
{
    private $pattern;

    public function __construct($pattern)
    {
        $this->pattern = '~'.str_replace('~', '\~', $pattern).'~';
    }

    public function match(ServerRequestInterface $serverRequest)
    {
        return 1 === preg_match($this->pattern, $serverRequest->getUri()->getPath());
    }
}
