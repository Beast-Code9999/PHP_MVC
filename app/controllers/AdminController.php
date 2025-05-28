<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AdminController {
    public function dashboard() {
        $data = [];
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


}
?>
