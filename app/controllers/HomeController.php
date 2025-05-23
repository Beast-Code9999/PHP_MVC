<?php 


class HomeController {

    public function index() {
        // route the index.php 
        require_once __DIR__ . '/../views/home/index.php';
    }

}