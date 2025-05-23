<?php 
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php'; // include routes variable



$request = isset($_GET['url']) ? rtrim($_GET['url'], '/') : ''; // if request is not set, set it and right trim it else empty



if(array_key_exists($request, $routes)) {

    // var_dump(rtrim($_GET['url'], '/'));
    // var_dump($routes[$request]);

    $route = explode('@', $routes[$request]);

    // route testing
    // echo "<pre>";
    // print_r($route);
    // echo "</pre>";


    /* it will look something like this 
    Array
        (
            [0] => HomeController // the controlelr
            [1] => index // the method
            [2] => testing
        )
    */

    $controllerName = $route[0];
    $methodName = $route[1];

    // dynamically grabbing controllers and instantiating the class to have access to the method
    $controller = new $controllerName(); // create new class of controller
    $controller->$methodName(); // find the right method within the file

    echo "True key exists in the routes";
} else {
    // later include a 404 page

    echo "404 - Page not found";
}