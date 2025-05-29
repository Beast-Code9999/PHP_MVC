<?php
require_once __DIR__ . '/../../config/database.php';

class Comment {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function add($article_id, $user_id, $content) {
        $stmt = $this->db->prepare("INSERT INTO comments (article_id, user_id, content) VALUES (?, ?, ?)");
        return $stmt->execute([$article_id, $user_id, $content]);
    }

    public function getByArticle($article_id) {
        $stmt = $this->db->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.article_id = ? ORDER BY c.created_at DESC");
        $stmt->execute([$article_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($comment_id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
        return $stmt->execute([$comment_id, $user_id]);
    }
}