<?php 
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php'; // include routes variable




$request = isset($_GET['url']) ? rtrim($_GET['url'], '/') : ''; // if request is not set, set it and right trim it else empty



if(array_key_exists($request, $routes)) {
    echo "True key exists in the routes";
} else {
    echo "The Key doesn't exist";
}