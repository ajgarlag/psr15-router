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

final class MethodRequestMatcher
{
    /**
     * @var string[]
     */
    private array $methods = [];

    /**
     * @param string[] $methods
     */
    public function __construct(array $methods)
    {
        $this->methods = array_map('strtoupper', $methods);
    }

    public function match(ServerRequestInterface $serverRequest): bool
    {
        return in_array($serverRequest->getMethod(), $this->methods, true);
    }
}
