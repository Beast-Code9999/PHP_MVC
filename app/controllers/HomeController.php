<?php 

// Move all require_once statements to the top for better organization
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Tag.php';
require_once __DIR__ . '/../models/Comment.php';

class HomeController {

    public function index() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';
        //echo views_path('home/index.php');
        // echo base_url();
        // echo base_path();
        // echo views_path('home/index.php');

        // Get the 5 most recent published articles
        $articleModel = new Article();
        $recentArticles = $articleModel->getFilteredArticles('', 0, 5); // Get 5 recent articles
        
        // Attach tags to each article for display
        $tagModel = new Tag();
        foreach ($recentArticles as &$article) {
            $article['tags'] = $tagModel->getTagsForArticle($article['id']);
        }
        unset($article);

        $data = [
            'title' => 'Home',
            'message' => 'Welcome to the home page',
            'recentArticles' => $recentArticles
        ];

        render('home/index', $data, 'layouts/hero_layout');
    }

    public function about() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';
        //echo views_path('home/about.php');

        $data = [
            'title' => 'About page',
            'message' => 'Welcome to the about page', 
            'text' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia odio hic magnam quisquam numquam error eaque assumenda qui, nisi cumque, maiores dolores recusandae doloribus temporibus labore molestiae harum exercitationem!',
        ];

        render('home/about', $data); // location of directory is home/about
    }   
    
    public function contact() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';
        //echo views_path('home/contact.php');

        $data = [
            'title' => 'Contact page',
            'message' => 'Welcome to the contact page', 
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia odio hic magnam quisquam numquam error eaque assumenda qui, nisi cumque, maiores dolores recusandae doloribus temporibus labore molestiae harum exercitationem!',
        ];

        render('home/contact', $data); // location of directory is home/contact
    }

    public function article() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $selectedTags = isset($_GET['tags']) ? (array)$_GET['tags'] : [];

        $articleModel = new Article();
        $tagModel = new Tag();
        $allTags = $tagModel->getAllTags();

        $articles = $articleModel->getFilteredArticles($search, 0, 50, $selectedTags);

        foreach ($articles as &$article) {
            $article['tags'] = $tagModel->getTagsForArticle($article['id']);
        }

        $data = [
            'title' => 'Articles',
            'articles' => $articles,
            'selectedTags' => $selectedTags,
            'allTags' => $allTags
        ];

        render('home/articles', $data);
    }

    public function singleArticle() {
        // Get ID from query parameter
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: /PHP_MVC/public/articles");
            exit;
        }
        
        $id = (int)$_GET['id'];
        
        // Connect to the database
        $db = new Database();
        $pdo = $db->connect();
        
        // Query to get the specific published article
        $sql = "SELECT a.*, u.username as author_name 
                FROM articles a 
                LEFT JOIN users u ON a.author_id = u.id 
                WHERE a.id = ? AND a.is_published = 1";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If article doesn't exist or isn't published, redirect to articles list
        if (!$article) {
            header("Location: /PHP_MVC/public/articles");
            exit;
        }

        // Use model to get article with tags
        $articleModel = new Article();
        $article = $articleModel->getArticleWithTags($id);
        if (!$article) {
            header("Location: /PHP_MVC/public/articles");
            exit;
        }

        $commentModel = new Comment();
        $comments = $commentModel->getByArticle($id);

        $data = [
            'article' => $article,
            'comments' => $comments,
        ];

        render('home/articleSingle', $data);
        return;
    }
    
    public function postComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
            $article_id = $_POST['article_id'];
            $content = trim($_POST['content']);
            $user_id = $_SESSION['user']['id'];

            if ($content) {
                $commentModel = new Comment();
                $commentModel->add($article_id, $user_id, $content);
            }
            header('Location: ' . base_url('article?id=' . $article_id));
            exit;
        }
    }

    public function deleteComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
            $comment_id = $_POST['comment_id'];
            $user_id = $_SESSION['user']['id'];
            $role_id = $_SESSION['user']['role_id'] ?? 0;

            $commentModel = new Comment();
            
            if (in_array($role_id, [2, 10])) {
                // Admin or Editor: can delete any comment
                $commentModel->deleteById($comment_id);
            } else {
                // Regular user: can only delete their own comment
                $commentModel->delete($comment_id, $user_id);
            }

            // Optionally, redirect back to the article
            $article_id = $_POST['article_id'];
            header('Location: ' . base_url('article?id=' . $article_id));
            exit;
        }
    }

    public function editComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
            $comment_id = $_POST['comment_id'];
            $article_id = $_POST['article_id'];
            $content = trim($_POST['content']);
            $user_id = $_SESSION['user']['id'];

            if ($content) {
                $commentModel = new Comment();
                $commentModel->update($comment_id, $user_id, $content);
            }
            header('Location: ' . base_url('article?id=' . $article_id));
            exit;
        }
    }
}