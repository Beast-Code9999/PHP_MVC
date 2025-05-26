<?php 


class HomeController {

    public function index() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';

        // echo base_url();
        // echo base_path();
        echo views_path('home/index.php');

        $data = [
            'title' => 'This is the main home page title',
            'message' => 'Welcome to the home page',
        ];

        render('home/index', $data, 'layouts/hero_layout');
    }

    public function about() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';

        $data = [
            'title' => 'About page',
            'message' => 'Welcome to the about page',
        ];

        render('home/about', $data); // location of directory is home/about
    } 
    
    
}