<?php 

class UserController {
    
    public function register() {

        $data = [
            'title' => 'Register Page',
        ];

        render('users/register', $data);
    }

    public function login() {

        $data = [
            'title' => 'Login Page',
        ];

        render('users/login', $data);
    }
    
}
