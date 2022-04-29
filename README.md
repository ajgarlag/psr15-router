Psr15 Router
============

The Psr15 Router component allows you to route [PSR-7] requests through [PSR-15] middlewares.

[![Build Status](https://travis-ci.org/ajgarlag/psr15-router.png?branch=master)](https://travis-ci.org/ajgarlag/psr15-router)
[![Latest Stable Version](https://poser.pugx.org/ajgarlag/psr15-router/v/stable.png)](https://packagist.org/packages/ajgarlag/psr15-router)
[![Latest Unstable Version](https://poser.pugx.org/ajgarlag/psr15-router/v/unstable.png)](https://packagist.org/packages/ajgarlag/psr15-router)
[![Total Downloads](https://poser.pugx.org/ajgarlag/psr15-router/downloads.png)](https://packagist.org/packages/ajgarlag/psr15-router)
[![Montly Downloads](https://poser.pugx.org/ajgarlag/psr15-router/d/monthly.png)](https://packagist.org/packages/ajgarlag/psr15-router)
[![Daily Downloads](https://poser.pugx.org/ajgarlag/psr15-router/d/daily.png)](https://packagist.org/packages/ajgarlag/psr15-router)
[![License](https://poser.pugx.org/ajgarlag/psr15-router/license.png)](https://packagist.org/ajgarlag/psr15-router)


Installation
------------

To install the latest stable version of this component, open a console and execute the following command:
```
$ composer require ajgarlag/psr15-router
```


Usage
-----

You can choose if you want to route your request through a [MiddlewareInterface] or a [RequestHandlerInterface]

### Middleware routing

With this option, you has to build a `Router` to discriminate which middleware will process the request.
Then build `RouterMiddleware` to process the request:

```php
use Ajgarlag\Psr15\Router\Matcher\UriRegexRequestMatcher;
use Ajgarlag\Psr15\Router\Middleware\Route;
use Ajgarlag\Psr15\Router\Middleware\ArrayRouter;
use Ajgarlag\Psr15\Router\Middleware\RouterMiddleware;

$userMiddleware; //Some middleware to process user requests
$userRoute = new Route(
    new UriRegexRequestMatcher('^http(s)?://example.org/user/'),
    $userMiddleware
);
$adminMiddleware; //Some middleware to process admin requests
$adminRoute = new Route(
    new UriRegexRequestMatcher('^http(s)?://example.org/admin/'),
    $adminMiddleware
);

$router = new ArrayRouter();
$router->addRoute($userRoute);
$router->addRoute($adminRoute);

$routerMiddleware = new RouterMiddleware($router);

$response = $routerMiddleware->process($request, $requestHandler);
```

If the router does not return any middleware to process the request, it is processed directly through the request
handler.


### Request handler routing

With this option, you has to build a `Router` to discriminate which request handler will process the request.
Then build `RouterRequestHandler` to process the request. A failover request handler is required to process the request
if the router cannot route the request. Usually this failover request handler should return a 404 response.

```php
use Ajgarlag\Psr15\Router\Matcher\UriRegexRequestMatcher;
use Ajgarlag\Psr15\Router\RequestHandler\Route;
use Ajgarlag\Psr15\Router\RequestHandler\ArrayRouter;
use Ajgarlag\Psr15\Router\RequestHandler\RouterRequestHandler;

$userRequestHandler; //Some request handler to process user requests
$userRoute = new Route(
    new UriRegexRequestMatcher('^http(s)?://example.org/user/'),
    $userRequestHandler
);
$adminRequestHandler; //Some request handler to process admin requests
$adminRoute = new Route(
    new UriRegexRequestMatcher('^http(s)?://example.org/admin/'),
    $adminRequestHandler
);

$router = new ArrayRouter();
$router->addRoute($userRoute);
$router->addRoute($adminRoute);

$failoverRequestHandler; // Request handler that returns 404 unconditionally
$routerRequestHandler = new RouterRequestHandler($router, $failoverRequestHandler);

$response = $routerRequestHandler->handle($request);
```

License
-------

This component is under the MIT license. See the complete license in the [LICENSE] file.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker].


Author Information
------------------

Developed with ♥ by [Antonio J. García Lagar].

If you find this component useful, please add a ★ in the [GitHub repository page] and/or the [Packagist package page].

[PSR-7]: http://www.php-fig.org/psr/psr-7/
[PSR-15]: https://www.php-fig.org/psr/psr-15/
[MiddlewareInterface]: https://www.php-fig.org/psr/psr-15/#22-psrhttpservermiddlewareinterface
[RequestHandlerInterface]: https://www.php-fig.org/psr/psr-15/#21-psrhttpserverrequesthandlerinterface
[LICENSE]: LICENSE
[Github issue tracker]: https://github.com/ajgarlag/psr15-router/issues
[Antonio J. García Lagar]: http://aj.garcialagar.es
[GitHub repository page]: https://github.com/ajgarlag/psr15-router
[Packagist package page]: https://packagist.org/packages/ajgarlag/psr15-router
