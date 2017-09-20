<?php

/*
 * PSR-15 Router by @ajgarlag
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgarlag\Psr15\Router\RequestHandler;

use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Router
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return RequestHandlerInterface|null
     */
    public function route(ServerRequestInterface $request);
}
