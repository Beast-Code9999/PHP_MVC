<?php 


class HomeController {

    public function index() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';
        echo views_path('home/index.php');
        // echo base_url();
        // echo base_path();
        // echo views_path('home/index.php');

        $data = [
            'title' => 'This is the main home page title',
            'message' => 'Welcome to the home page',

        ];

        render('home/index', $data, 'layouts/hero_layout');
    } 

    public function about() {
        // route the index.php 
        // require_once __DIR__ . '/../views/home/index.php';
        echo views_path('home/about.php');

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
        echo views_path('home/contact.php');

        $data = [
            'title' => 'Contact page',
            'message' => 'Welcome to the contact page', 
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia odio hic magnam quisquam numquam error eaque assumenda qui, nisi cumque, maiores dolores recusandae doloribus temporibus labore molestiae harum exercitationem!',
        ];

        render('home/contact', $data); // location of directory is home/contact
    }

    public function article() {
        // Connect to the database
        $db = new Database();
        $pdo = $db->connect();
        
        // Query to get all published articles
        $sql = "SELECT a.*, u.username as author_name 
                FROM articles a 
                LEFT JOIN users u ON a.author_id = u.id 
                WHERE a.is_published = 1
                ORDER BY a.created_at DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $data = [
            'title' => 'Articles',
            'message' => 'Latest Articles',
            'articles' => $articles
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
        
        $data = [
            'title' => $article['title'],
            'article' => $article
        ];
        
        render('home/articleSingle', $data);
    }
}