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

        $hashedPassword = $password; // plain for now, change to password_hash($password, PASSWORD_DEFAULT) later

        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role_id' => 3, // default role = user
        ]);
    }
}
