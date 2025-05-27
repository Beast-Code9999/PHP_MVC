<?php 



$routes = [
    'GET' => [
        '' => 'HomeController@index', // home controller with class index
        'about' => 'HomeController@about',
        'user/login' => 'UserController@login', 
        'contact' => 'HomeController@contact',
        'articles' => 'HomeController@article',
        'user/register' => 'UserController@register',
        'login' => 'UserController@login',
    ],
    'POST' => [
        'register' => 'UserController@registerUser',
        'user/login' => 'UserController@loginUser',
    ],
];

// associative arrays of routes
// $routes = [
//     '' => 'HomeController@index', // home controller with class index
//     'about' => 'HomeController@about',
//     'user/login' => 'UserController@login', 
//     'contact' => 'HomeController@contact',
//     'user/register' => 'UserController@register',
//     'login' => 'UserController@login',
// ];





// Browser → public/index.php → Router → Controller → render() → View
// URL → Router Array → Controller@Method → render() → View