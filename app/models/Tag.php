<?php
require_once __DIR__ . '/../../config/database.php';

class Tag {
    private $db;
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAllTags() {
        $stmt = $this->db->prepare('SELECT * FROM tags ORDER BY tag_name ASC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagsForArticle($article_id) {
        $stmt = $this->db->prepare('SELECT t.* FROM tags t INNER JOIN article_tags at ON t.tag_id = at.tag_id WHERE at.article_id = ?');
        $stmt->execute([$article_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setTagsForArticle($article_id, $tag_ids) {
        // Remove existing tags
        $this->db->prepare('DELETE FROM article_tags WHERE article_id = ?')->execute([$article_id]);
        // Add new tags
        $stmt = $this->db->prepare('INSERT INTO article_tags (article_id, tag_id) VALUES (?, ?)');
        foreach ($tag_ids as $tag_id) {
            $stmt->execute([$article_id, $tag_id]);
        }
    }
}
