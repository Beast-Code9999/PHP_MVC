<?php 



$routes = [
<<<<<<< HEAD
    'GET' => [
        '' => 'HomeController@index', // home controller with class index
        'about' => 'HomeController@about',
        'user/login' => 'UserController@login', 
        'contact' => 'HomeController@contact',
        'user/register' => 'UserController@register',
        'login' => 'UserController@login',
    ],
    'POST' => [
         
    ],
=======
    '' => 'HomeController@index', // home controller with class index
    'about' => 'HomeController@about',
    'user/login' => 'UserController@login', 
    'contact' => 'HomeController@contact',
    'user/register' => 'UserController@register',
    'login' => 'UserController@login',
    'articles' => 'HomeController@article',
>>>>>>> 77f2e368893e5d2a4411ad34daab083a4fe1ab3c
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