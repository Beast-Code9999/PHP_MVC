<?php

class UserController {
    
    public function register() {
        $data = [
            'title' => 'Register Page',
            'errors' => [],
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
}
