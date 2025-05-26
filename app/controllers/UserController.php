<?php 

class UserController {
    
    public function register() {

        $data = [
            'title' => 'Register Page',
        ];

        render('users/register', $data);
    }
    
}