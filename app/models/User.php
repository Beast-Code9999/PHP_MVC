<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Regular user registration — always role_id = 3
    public function create($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password, role_id, created_at) 
                VALUES (:username, :email, :password, :role_id, NOW())";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role_id' => 3, // default role = user
        ]);
    }

    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // Admin user creation — accepts a role_id
    public function createByAdmin($username, $email, $password, $role_id) {
        $sql = "INSERT INTO users (username, email, password, role_id, created_at) 
                VALUES (:username, :email, :password, :role_id, NOW())";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role_id' => $role_id,
        ]);
    }

    // Login method
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch all users
    public function getAllUsers() {
        $sql = "SELECT id, username, email, role_id, created_at FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete user (and their articles)
    public function deleteUserById($id) {
        $stmtArticles = $this->conn->prepare("DELETE FROM articles WHERE author_id = ?");
        $stmtArticles->execute([$id]);

        $stmtUser = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmtUser->execute([$id]);
    }
}
