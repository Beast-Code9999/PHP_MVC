<?php
require_once __DIR__ . '/../../config/database.php';

class Article {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getFilteredArticles($search = '', $offset = 0, $limit = 50, $tagIds = []) {
        $sql = "SELECT DISTINCT articles.*, users.username AS author_name
                FROM articles
                LEFT JOIN users ON articles.author_id = users.id
                LEFT JOIN article_tags ON articles.id = article_tags.article_id
                LEFT JOIN tags ON article_tags.tag_id = tags.tag_id
                WHERE articles.is_published = 1";
        $params = [];

        if ($search !== '') {
            $sql .= " AND (articles.title LIKE ? OR articles.content LIKE ? OR tags.tag_name LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        if (!empty($tagIds)) {
            $in = implode(',', array_fill(0, count($tagIds), '?'));
            $sql .= " AND article_tags.tag_id IN ($in)";
            foreach ($tagIds as $tagId) {
                $params[] = $tagId;
            }
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
    
    public function getArticleWithTags($id) {
        $stmt = $this->db->prepare("SELECT a.*, u.username AS author_name FROM articles a LEFT JOIN users u ON a.author_id = u.id WHERE a.id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($article) {
            require_once __DIR__ . '/Tag.php';
            $tagModel = new Tag();
            $article['tags'] = $tagModel->getTagsForArticle($id);
        }
        return $article;
    }
    
    public function createArticleWithTags($title, $content, $author_id, $is_published, $allow_comments, $image_data, $tag_ids) {
        $sql = "INSERT INTO articles (title, content, author_id, is_published, allow_comments, created_at, updated_at, image_data) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $content, $author_id, $is_published, $allow_comments, $image_data]);
        $article_id = $this->db->lastInsertId();
        require_once __DIR__ . '/Tag.php';
        $tagModel = new Tag();
        $tagModel->setTagsForArticle($article_id, $tag_ids);
        return $article_id;
    }

    public function updateArticleWithTags($id, $title, $content, $is_published, $allow_comments, $image_data, $tag_ids) {
        $sql = "UPDATE articles SET title = ?, content = ?, is_published = ?, allow_comments = ?, updated_at = NOW(), image_data = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $content, $is_published, $allow_comments, $image_data, $id]);
        require_once __DIR__ . '/Tag.php';
        $tagModel = new Tag();
        $tagModel->setTagsForArticle($id, $tag_ids);
        return true;
    }
}
?>
