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

                    // Role-based redirect - ONLY CHANGE HERE
                    if (in_array($user['role_id'], [1, 2, 10])) {
                        // Authors, Editors, Admins go to admin dashboard
                        header('Location: ' . base_url('admin/dashboard'));
                    } else {
                        // Regular users go to homepage
                        header('Location: ' . base_url(''));
                    }
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

    public function logout() {
        // Destroy the session
        session_destroy();
        
        // Redirect to homepage
        header('Location: ' . base_url(''));
        exit;
    }
}

