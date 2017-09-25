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

class UriSchemeRequestMatcher
{
    private $schemes;

    public function __construct($schemes)
    {
        $this->schemes = array_map('strtolower', (array) $schemes);
    }

    public function match(ServerRequestInterface $serverRequest)
    {
        return in_array($serverRequest->getUri()->getScheme(), $this->schemes, true);
    }
}
