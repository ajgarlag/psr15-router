<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgarlag\Psr15\Router\Delegate;

use Ajgarlag\Psr15\Router\Matcher\RequestMatcher;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;

class Route
{
    private $requestMatcher;
    private $delegate;

    /**
     * @param ServerRequestMatcher $requestMatcher
     * @param DelegateInterface    $delegate
     */
    public function __construct(RequestMatcher $requestMatcher, DelegateInterface $delegate)
    {
        $this->requestMatcher = $requestMatcher;
        $this->delegate = $delegate;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return bool
     */
    public function match(ServerRequestInterface $request)
    {
        return $this->requestMatcher->match($request);
    }

    /**
     * @return DelegateInterface
     */
    public function getDelegate()
    {
        return $this->delegate;
    }
}
