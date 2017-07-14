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

You can choose if you want to route your request through a [MiddlewareInterface] or a [DelegateInterface]

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

$response = $routerMiddleware->process($request, $delegate);
```

If the router does not return any middleware to process the request, it is processed directly through the delegate.


### Delegate routing

With this option, you has to build a `Router` to discriminate which delegate will process the request.
Then build `RouterDelegate` to process the request. A failover delegate is required to process the request if the router
cannot route the request. Usually this failover delegate should return a 404 response.

```php
use Ajgarlag\Psr15\Router\Matcher\UriRegexRequestMatcher;
use Ajgarlag\Psr15\Router\Delegate\Route;
use Ajgarlag\Psr15\Router\Delegate\ArrayRouter;
use Ajgarlag\Psr15\Router\Delegate\RouterDelegate;

$userDelegate; //Some delegate to process user requests
$userRoute = new Route(
    new UriRegexRequestMatcher('^http(s)?://example.org/user/'),
    $userDelegate
);
$adminDelegate; //Some delegate to process admin requests
$adminRoute = new Route(
    new UriRegexRequestMatcher('^http(s)?://example.org/admin/'),
    $adminDelegate
);

$router = new ArrayRouter();
$router->addRoute($userRoute);
$router->addRoute($adminRoute);

$failoverDelegate; // Delegate that returns 404 unconditionally
$routerDelegate = new RouterDelegate($router, $failoverDelegate);

$response = $routerDelegate->process($request);
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
[PSR-15]: https://github.com/http-interop/http-middleware
[MiddlewareInterface]: https://github.com/http-interop/http-middleware/blob/master/src/MiddlewareInterface.php
[DelegateInterface]: https://github.com/http-interop/http-middleware/blob/master/src/DelegateInterface.php
[LICENSE]: LICENSE
[Github issue tracker]: https://github.com/ajgarlag/psr15-router/issues
[Antonio J. García Lagar]: http://aj.garcialagar.es
[GitHub repository page]: https://github.com/ajgarlag/psr15-router
[Packagist package page]: https://packagist.org/packages/ajgarlag/psr15-router
