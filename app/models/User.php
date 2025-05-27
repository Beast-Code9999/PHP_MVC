<?php

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password, role_id, created_at) 
                VALUES (:username, :email, :password, :role_id, NOW())";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = $password; // You can switch this to password_hash($password, PASSWORD_DEFAULT)

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role_id' => 3, // default role = user
        ]);
    }

    //login method

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
