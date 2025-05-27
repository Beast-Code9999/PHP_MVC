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

    public function registerUser() {
        // Registration logic here (you already have this)
    }

    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            $errors = [];

            if ($user) {
                // Plaintext password check (for now; should hash later)
                if ($password === $user['password']) {
                    // Login success
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];

                    header('Location: ' . base_url('')); // adjust destination as needed
                    exit;
                } else {
                    $errors[] = 'Incorrect password.';
                }
            } else {
                $errors[] = 'No account found with that email.';
            }

            // Redisplay login form with errors
            $data = [
                'title' => 'Login Page',
                'errors' => $errors
            ];
            render('users/login', $data);

        } else {
            // If not POST, redirect to login page
            header('Location: ' . base_url('user/login'));
            exit;
        }
    }
}

