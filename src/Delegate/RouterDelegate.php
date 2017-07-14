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

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterDelegate implements DelegateInterface
{
    private $router;
    private $failoverDelegate;

    public function __construct(Router $router, DelegateInterface $failoverDelegate)
    {
        $this->router = $router;
        $this->failoverDelegate = $failoverDelegate;
    }

    public function process(ServerRequestInterface $request)
    {
        if (null === $delegate = $this->router->route($request)) {
            return $this->failoverDelegate->process($request);
        }

        return $delegate->process($request);
    }
}
