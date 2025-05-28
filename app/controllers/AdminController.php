<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Article.php';

class AdminController {
    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            die("Access denied. Please log in.");
        }
    
        $roleId = $_SESSION['user']['role_id'];
    
        $data = [
            'roleId' => $roleId
        ];
        
        render('admin/dashboard', $data, "admin/layout");
    }

    public function userList() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
            die("Access denied. This page is for admins only.");
        }

        $userModel = new User();
        $users = $userModel->getAllUsers();

        $roleNames = [
            1 => 'Author',
            2 => 'Editor',
            3 => 'User',
            10 => 'Admin'
        ];

        $data = [
            'users' => $users,
            'roleNames' => $roleNames,
            'currentUserId' => $_SESSION['user']['id'] ?? null,
        ];

        render('admin/userlist', $data, layout:'admin/layout');
    }

    public function updateUser() {
        $db = new Database();
        $pdo = $db->connect();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
            die("Access denied. Admins only.");
        }

        if (!isset($_GET['id'])) {
            die("User ID is missing.");
        }

        $userId = (int)$_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("User not found.");
        }

        $error = '';
        $success = '';
        $roleNames = [
            1 => 'Author',
            2 => 'Editor',
            3 => 'User',
            10 => 'Admin'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $role_id = (int)$_POST['role_id'];
            $newPassword = trim($_POST['password']);

            if (empty($username) || empty($email)) {
                $error = "Username and Email are required.";
            } else {
                if (!empty($newPassword)) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $update = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ?, role_id = ? WHERE id = ?");
                    $update->execute([$username, $email, $hashedPassword, $role_id, $userId]);
                } else {
                    $update = $pdo->prepare("UPDATE users SET username = ?, email = ?, role_id = ? WHERE id = ?");
                    $update->execute([$username, $email, $role_id, $userId]);
                }

                $success = "User details updated successfully.";

                $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->execute([$userId]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        $data = [
            'user' => $user,
            'roleNames' => $roleNames,
            'error' => $error,
            'success' => $success
        ];

        render('admin/updateUser', $data, layout: 'admin/updateUser');
    }

    
public function deleteUser() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
        die("Access denied. Admins only.");
    }

    if (!isset($_GET['id'])) {
        die("User ID is missing.");
    }

    $userId = (int)$_GET['id'];

        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();

    try {
        if ($userModel->deleteUserById($userId)) {
            header("Location: /PHP_MVC/public/admin/userlist");
            exit;
        } else {
            die("Failed to delete user.");
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Cannot delete user: user has associated data (e.g. articles).");
        } else {
            die("Error deleting user: " . $e->getMessage());
        }
    }
}

    public function createUser() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
            die("Access denied. Only admins can access this page.");
        }

        $error = '';
        $success = '';
        $roleNames = [
            1 => 'Author',
            2 => 'Editor',
            3 => 'User',
            10 => 'Admin'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role_id = (int)$_POST['role_id'];

            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } elseif ($password !== $confirmPassword) {
                $error = "Passwords do not match.";
            } elseif (!in_array($role_id, array_keys($roleNames))) {
                $error = "Invalid role selected.";
            } else {
                $userModel = new User();

                if ($userModel->usernameExists($username)) {
                    $error = "Username already exists.";
                } elseif ($userModel->emailExists($email)) {
                    $error = "Email already exists.";
                } else {
                    $created = $userModel->createByAdmin($username, $email, $password, $role_id);
                    if ($created) {
                        $success = "User created successfully.";
                    } else {
                        $error = "An error occurred. Could not create user.";
                    }
                }
            }
        }

        $data = [
            'error' => $error,
            'success' => $success,
            'roleNames' => $roleNames
        ];

        render('admin/createUser', $data, layout: 'admin/layout');
    }

    public function articles() {
        if (!isset($_SESSION['user'])) {
            die("Access denied. Please log in.");
        }
        
        // Connect to database
        $db = new Database();
        $pdo = $db->connect();
        
        // Simple query to get all articles
        $sql = "SELECT a.*, u.username as author_name 
                FROM articles a 
                LEFT JOIN users u ON a.author_id = u.id 
                ORDER BY a.created_at DESC";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $data = [
            'articles' => $articles
        ];
        
        render('admin/publishedArticles', $data, "admin/layout");
    }

}
?>
