<?php 

$routes = [
    'GET' => [
        '' => 'HomeController@index',
        'about' => 'HomeController@about',
        'user/login' => 'UserController@login',
        'user/logout' => 'UserController@logout',
        'contact' => 'HomeController@contact',
        'articles' => 'HomeController@article',
        'user/register' => 'UserController@register',
        'login' => 'UserController@login',

        'admin/dashboard'=> 'AdminController@dashboard',
        'admin/userlist' => 'AdminController@userList',
        'admin/updateUser' => 'AdminController@updateUser',
        'admin/deleteUser' => 'AdminController@deleteUser',
<<<<<<< HEAD
        'admin/createUser' => 'AdminController@createUser',
=======
        'admin/articles/published' => 'AdminController@articles',

>>>>>>> d9d2a7501067f82557e56c89a956d79cb87bbc60
    ],
    'POST' => [
        'register' => 'UserController@registerUser',
        'user/login' => 'UserController@loginUser',
        'admin/updateUser' => 'AdminController@updateUser',
        'admin/createUser' => 'AdminController@createUser',
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