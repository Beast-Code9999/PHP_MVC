<?php 

$routes = [
    'GET' => [
        '' => 'HomeController@index',
        'about' => 'HomeController@about',
        'contact' => 'HomeController@contact',
        'articles' => 'HomeController@article',
        'article' => 'HomeController@singleArticle',

        'user/register' => 'UserController@register',
        'login' => 'UserController@login',
        'user/login' => 'UserController@login',
        'user/logout' => 'UserController@logout',

        'admin/dashboard'=> 'AdminController@dashboard',
        'admin/userlist' => 'AdminController@userList',
        'admin/updateUser' => 'AdminController@updateUser',
        'admin/deleteUser' => 'AdminController@deleteUser',
        'admin/articles' => 'AdminController@articles',
        
        'admin/reviewArticles' => 'AdminController@reviewArticles',
        'admin/editArticles' => 'AdminController@editArticles',
        'admin/deletearticle ' => 'AdminController@deleteArticles',
        'admin/createUser' => 'AdminController@createUser',
        'admin/createArticle' => 'AdminController@createArticle',
        'admin/yourArticles' => 'AdminController@yourArticles',
        'admin/drafts' => 'AdminController@drafts',
        
    ],
    'POST' => [
        'register' => 'UserController@registerUser',
        'user/login' => 'UserController@loginUser',
        'admin/updateUser' => 'AdminController@updateUser',
        'admin/createUser' => 'AdminController@createUser',
        'admin/editArticles' => 'AdminController@editArticles',
        'admin/deleteArticles' => 'AdminController@deleteArticles',
        'post-comment' => 'HomeController@postComment',
        'delete-comment' => 'HomeController@deleteComment',
        'edit-comment' => 'HomeController@editComment',
        'admin/createArticle' => 'AdminController@createArticle',
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