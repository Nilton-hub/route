Application Router for PHP
===========================

For more details, see the examples folder inside the library. It has no dependencies.

Its use is ridiculously easy!
-----------------------------

I recommend that you create an index.php file in the root of the public folder that will be accessed by the server when it receives a request from some page of your application and call composer autoload to load Route like this:

```php
<?php
require __DIR__ . '/path/to/vendor/autoload.php';
```

Start by instantiating the ```Route\Route\Route``` class that implements the ```Route\Route\RouteInterface``` interface.

```php
$route = new Route\Route\Route();
```

The Route component supports the five most common HTTP methods in applications, GET, POST, PUT, PATCH and DELETE.

To define a route, call one of the ```Route\Route\RouteInterface``` interface methods passing a route and a handler:

```php
$route->get('/route-name', 'handler');
```

The handler can be a method of a class or a callback function.

______________________________________________________________________

Passing parameters via URL
--------------------------
Route works with friendly URL and you can pass parameters via URL between curly braces without using querystring. Remembering that you can still use them if you prefer.

```php
$route->get('/route-name/{foo}/{bar}', function (array $params) {
    print_r($params);
    echo '<p>Page content</p>';
});
```

Respond to other HTTP methods
-----------------------------
If the handler is a class with a method, you must write in the second parameter as a string the fully qualified name of the class as recommended by PSR-4, separated from the method by the character @.
```php
$route->get('/route-one', 'VendorNamespace\SubNamespace\ControllerName@methodA');
$route->post('/route-two', 'VendorNamespace\SubNamespace\ControllerName@methodB');
$route->put('/route-three', 'VendorNamespace\SubNamespace\ControllerName@methodC');
$route->patch('/route-four', 'VendorNamespace\SubNamespace\ControllerName@methodD');
$route->delete('/route-five', 'VendorNamespace\SubNamespace\ControllerName@methodE');
```

dispatching the route
---------------------

After defining all the routes of your web application, call the ```run()``` method which will do the routing based on the accessed URI.

```php
$route->run();
```

To catch errors, just call the ```getError()``` method after ```run()```, which will return an object with the error information. As in the case of a non-existent route.
```php
if ($route->getError()) {
    // Handle errors here.
    $code = $error->getHttpErrorCode();
    $message = $error->getHttpErrorMessage();
    echo "Error {$code}, {$message}!";
}
```
