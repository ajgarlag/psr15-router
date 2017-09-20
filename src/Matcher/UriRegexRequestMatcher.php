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

class UriRegexRequestMatcher implements RequestMatcher
{
    private $uriPattern;

    /**
     * @param string $uriPattern
     */
    public function __construct($uriPattern)
    {
        $this->uriPattern = '~'.str_replace('~', '\~', $uriPattern).'~';
    }

    public function match(ServerRequestInterface $request)
    {
        return 1 === preg_match($this->uriPattern, (string) $request->getUri());
    }
}
