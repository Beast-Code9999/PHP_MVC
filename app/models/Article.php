<?php
require_once __DIR__ . '/../../config/database.php';

class Article {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getFilteredArticles($search = '', $offset = 0, $limit = 50) {
        $sql = "SELECT articles.*, users.username AS author_name
                FROM articles
                LEFT JOIN users ON articles.author_id = users.id
                WHERE articles.is_published = 1";
        $params = [];
    
        if ($search !== '') {
            $sql .= " AND (articles.title LIKE :search OR articles.content LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
    
        $offset = (int)$offset;
        $limit = (int)$limit;
        $sql .= " ORDER BY articles.created_at DESC LIMIT $offset, $limit";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countFilteredArticles($search = '', $author_id = 0, $is_published = 1) {
        $sql = "SELECT COUNT(*) as total FROM articles WHERE 1=1";
        
        $params = [];
        
        // Add search condition if provided
        if (!empty($search)) {
            $sql .= " AND (title LIKE ? OR content LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        
        // Filter by author if provided
        if ($author_id > 0) {
            $sql .= " AND author_id = ?";
            $params[] = $author_id;
        }
        
        // Filter by publication status
        if ($is_published !== null) {
            $sql .= " AND is_published = ?";
            $params[] = $is_published;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['total'];
    }
    
    public function getArticleById($id) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createArticle($title, $content, $author_id, $is_published = 0) {
        $sql = "INSERT INTO articles (title, content, author_id, is_published, created_at, updated_at) 
                VALUES (?, ?, ?, ?, NOW(), NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $content, $author_id, $is_published]);
    }
    
    public function updateArticle($id, $title, $content, $is_published = null) {
        $sql = "UPDATE articles SET title = ?, content = ?, updated_at = NOW()";
        $params = [$title, $content];
        
        if ($is_published !== null) {
            $sql .= ", is_published = ?";
            $params[] = $is_published;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    public function deleteArticle($id) {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
