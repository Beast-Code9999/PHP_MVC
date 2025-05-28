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

public function createUser() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
        die("Access denied. Only admins can access this page.");
    }

    $roleNames = [
        1 => 'Author',
        2 => 'Editor',
        3 => 'User',
        10 => 'Admin'
    ];

    $errors = [];
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $role_id = (int)$_POST['role_id'];

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

        if (!in_array($role_id, array_keys($roleNames))) {
            $errors[] = "Invalid role selected.";
        }

        $userModel = new User();

        if ($userModel->usernameExists($username)) {
            $errors[] = "The username is already taken.";
        }

        if ($userModel->emailExists($email)) {
            $errors[] = "The email is already registered.";
        }

        // Create user if no errors
        if (empty($errors)) {
            $created = $userModel->createByAdmin($username, $email, $password, $role_id);
            if ($created) {
                $success = "User created successfully.";
            } else {
                $errors[] = "An error occurred. Could not create user.";
            }
        }
    }

    render('admin/createUser', [
        'title' => 'Create User',
        'errors' => $errors,
        'success' => $success,
        'roleNames' => $roleNames
    ], layout: 'admin/layout');
}

    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            $errors = [];

            if ($user) {
                if ($password === $user['password']) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];

                    if (in_array($user['role_id'], [1, 2, 10])) {
                        header('Location: ' . base_url('admin/dashboard'));
                    } else {
                        header('Location: ' . base_url(''));
                    }
                    exit;
                } else {
                    $errors[] = 'Incorrect password.';
                }
            } else {
                $errors[] = 'No account found with that email.';
            }

            render('users/login', [
                'title' => 'Login Page',
                'errors' => $errors
            ]);

        } else {
            header('Location: ' . base_url('user/login'));
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . base_url(''));
        exit;
    }
}
