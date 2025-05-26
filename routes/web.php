<?php 

// associative arrays of routes
$routes = [
    '' => 'HomeController@index', // home controller with class index
    'about' => 'HomeController@about',
    'user/login' => 'UserController@login', 
    'contact' => 'HomeController@contact',
    'user/register' => 'UserController@register',
]; 



// Browser → public/index.php → Router → Controller → render() → View
// URL → Router Array → Controller@Method → render() → View