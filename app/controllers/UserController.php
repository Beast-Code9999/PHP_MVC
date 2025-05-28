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
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $agreeTerms = isset($_POST['agree_terms']);

            $errors = [];

            // Validation
            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                $errors[] = "All fields are required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if ($password !== $confirmPassword) {
                $errors[] = "Passwords do not match.";
            }

            if (!$agreeTerms) {
                $errors[] = "You must agree to the privacy policy.";
            }

            if (!empty($errors)) {
                // Return back to the registration page with errors
                render('users/register', [
                    'title' => 'Register Page',
                    'errors' => $errors
                ]);
                return;
            }

            // Save user
            $user = new User();
            $created = $user->create($username, $email, $password);

            if ($created) {
                // Redirect to login
                header('Location: ' . base_url('user/login'));
                exit;
            } else {
                $errors[] = "An error occurred while creating your account. Please try again.";
                render('users/register', [
                    'title' => 'Register Page',
                    'errors' => $errors
                ]);
            }
        }
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

