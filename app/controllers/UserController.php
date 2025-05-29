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

            // Check for duplicate username or email
            $user = new User();

            if ($user->usernameExists($username)) {
                $errors[] = "The username is already taken.";
            }

            if ($user->emailExists($email)) {
                $errors[] = "The email is already registered.";
            }

            if (!empty($errors)) {
                render('users/register', [
                    'title' => 'Register Page',
                    'errors' => $errors
                ]);
                return;
            }

            // Save user
            $created = $user->create($username, $email, $password);

            if ($created) {
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
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $errors = [];

            if (empty($email) || empty($password)) {
                $errors[] = "Email and password are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (empty($errors)) {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if ($user) {
                    $hashedPassword = $user['password'];

                    // Accept both hashed and plain text passwords
                    $isValidPassword = password_verify($password, $hashedPassword) || $password === $hashedPassword;

                    if ($isValidPassword) {
                        // ✅ Login success
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'email' => $user['email'],
                            'role_id' => $user['role_id'],
                        ];

                        // Redirect based on role
                        if (in_array($user['role_id'], [1, 2, 10])) {
                            header('Location: ' . base_url('admin/dashboard'));
                        } else {
                            header('Location: ' . base_url(''));
                        }
                        exit;
                    }
                }

                $errors[] = "Invalid email or password.";
            }

            // Show login view with errors
            render('users/login', [
                'title' => 'Login',
                'errors' => $errors,
            ]);
        } else {
            // Show login form
            render('users/login', ['title' => 'Login']);
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . base_url(''));
        exit;
    }
}
