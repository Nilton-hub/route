<?php
use Route\Route\Route;
require __DIR__ . "/vendor/autoload.php";

$route = new Route();
# Always use the @ character to separate the class name from the method name. You must enter the fully qualified name of the class.
$route->get('/', 'Src\Controllers\App@home'); // The root route is defined only with a slash.
$route->get('/about-us', 'Src\Controllers\App@about'); // Methods that execute routes receive a route and a route handler.
$route->get('/blog/my-articles/{user}/{category}/{uri}', 'Src\Controllers\App@blog'); // You can pass parameters between curly braces and separated by slashes...
$route->get('/blog/my-articles/{user}/{category}/{uri}/{pubDate}', 'Src\Controllers\App@blog'); // ... and add more parameters to an existing route. The new parameters become optional.
$route->get('/terms/{param_a}/{param_b}', function (array $data) { //The route handler can be a callback
    print_r($data);
    echo '<h1>Our Terms</h1><p>Lorem ipsum dolor sit amet.</p>';
});

# To create routes for the other HTTP methods, just call the method of the Route class with the name of the respective method and pass the same parameters as get.
$route->post('/signup', 'Src\Controllers\App@register');
$route->post('/sign-in', 'Src\Controllers\App@login');
$route->put('/comments/edit', 'Src\Controllers\App@commentsUpdate');
$route->put('/replies/edit', function (array $data) {
    // Code...
});
$route->delete('/replies/{reply_id}', function () {
    // Code...
});

$route->run(); // After defining all the routes in your application, call the run() method to monitor requests and execute a handler.

if ($error = $route->getError()) {
    // Handle errors here.
    $code = $error->getHttpErrorCode();
    $message = $error->getHttpErrorMessage();
    echo "Error {$code}, {$message}!";
}
