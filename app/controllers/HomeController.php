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
        echo views_path('home/about.php');

        $data = [
            'title' => 'About page',
            'message' => 'Welcome to the about page', 
            'text' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia odio hic magnam quisquam numquam error eaque assumenda qui, nisi cumque, maiores dolores recusandae doloribus temporibus labore molestiae harum exercitationem!',
        ];

        render('home/about', $data); // location of directory is home/about
    }   
    
    public function contact() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';
        echo views_path('home/contact.php');

        $data = [
            'title' => 'Contact page',
            'message' => 'Welcome to the contact page', 
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia odio hic magnam quisquam numquam error eaque assumenda qui, nisi cumque, maiores dolores recusandae doloribus temporibus labore molestiae harum exercitationem!',
        ];

        render('home/contact', $data); // location of directory is home/contact
    }
}