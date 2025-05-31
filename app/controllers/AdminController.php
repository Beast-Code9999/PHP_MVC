<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Article.php';


class AdminController {
    const MAX_BLOB_SIZE = 2097152; // 2MB = 2,097,152 bytes for images

    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            die("Access denied. Please log in.");
        }
    
        $roleId = $_SESSION['user']['role_id'];
    
        $data = [
            'roleId' => $roleId
        ];
        
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

    public function createUser() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
            die("Access denied. Only admins can access this page.");
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
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role_id = (int)$_POST['role_id'];

            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } elseif ($password !== $confirmPassword) {
                $error = "Passwords do not match.";
            } elseif (!in_array($role_id, array_keys($roleNames))) {
                $error = "Invalid role selected.";
            } else {
                $userModel = new User();

                if ($userModel->usernameExists($username)) {
                    $error = "Username already exists.";
                } elseif ($userModel->emailExists($email)) {
                    $error = "Email already exists.";
                } else {
                    $created = $userModel->createByAdmin($username, $email, $password, $role_id);
                    if ($created) {
                        $success = "User created successfully.";
                    } else {
                        $error = "An error occurred. Could not create user.";
                    }
                }
            }
        }

        $data = [
            'error' => $error,
            'success' => $success,
            'roleNames' => $roleNames
        ];

        render('admin/createUser', $data, layout: 'admin/layout');
    }

    public function articles() {
        if (!isset($_SESSION['user'])) {
            die("Access denied. Please log in.");
        }
        
        // Connect to database
        $db = new Database();
        $pdo = $db->connect();
        
        // Simple query to get all articles
        $sql = "SELECT a.*, u.username as author_name 
                FROM articles a 
                LEFT JOIN users u ON a.author_id = u.id 
                ORDER BY a.created_at DESC";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $data = [
            'articles' => $articles
        ];
        
        render('admin/allArticles', $data, "admin/layout");
    }


    public function reviewArticles() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 10) {
            die("Access denied. Admins only.");
        }

        $db = new Database();
        $pdo = $db->connect();

        $stmt = $pdo->query("
        SELECT a.id, a.title, a.content, a.created_at, a.image_data, u.username 
        FROM articles a
        JOIN users u ON a.author_id = u.id
        WHERE a.is_published = 0
        ORDER BY a.created_at DESC
        ");

        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'articles' => $articles
        ];

        render('admin/reviewArticles', $data, layout: 'admin/layout');
    }

    
    public function editArticles() {
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role_id'], [2, 10])) {
            die("Access denied. Admins and Editors only");
        }
    
        $db = new Database();
        $pdo = $db->connect();
    
        $id = $_GET['id'] ?? null;
        if (!$id) die("Missing article ID.");
        
        // Determine where to redirect back based on referer
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $backPage = 'admin/articles'; // Default
        
        // Check if they came from review articles page
        if (strpos($referer, 'reviewArticles') !== false) {
            $backPage = 'admin/reviewArticles';
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $isPublished = isset($_POST['is_published']) ? 1 : 0;
            $allow_comments = isset($_POST['allow_comments']) ? 1 : 0;
            $removeImage = isset($_POST['remove_image']) && $_POST['remove_image'] == '1';
    
            // Get the source page from the form submission
            $backPage = $_POST['source'] ?? 'admin/articles';
    
            // Fetch existing image
            $stmt = $pdo->prepare("SELECT image_data FROM articles WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Handle image removal or replacement
            if ($removeImage) {
                $imageData = null; // Remove the image
            } else {
                $imageData = $existing['image_data']; // Keep existing image
            }
    
            $error = null;
    
            // Handle new image upload (only if no error and new file uploaded)
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageTmp = $_FILES['image']['tmp_name'];
                $imageSize = filesize($imageTmp);
            
                if ($imageSize > self::MAX_BLOB_SIZE) {
                    $error = "Image is too large. Max allowed is " . number_format(self::MAX_BLOB_SIZE) . " bytes. Please choose a smaller image.";
                } else {
                    $imageData = file_get_contents($imageTmp); // New image replaces everything
                }
            }
    
            if (!$error) {
                $stmt = $pdo->prepare("UPDATE articles 
                    SET title = ?, content = ?, is_published = ?, allow_comments = ?, image_data = ?, updated_at = NOW() 
                    WHERE id = ?");
                $stmt->execute([$title, $content, $isPublished, $allow_comments, $imageData, $id]);
    
                // Instead of redirecting, set a success message and show the form again
                $success = "Article updated successfully.";
    
                // Fetch updated article data
                $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
                $stmt->execute([$id]);
                $article = $stmt->fetch(PDO::FETCH_ASSOC);
    
                render('admin/editArticles', [
                    'article' => $article,
                    'success' => $success,
                    'error' => null,
                    'backPage' => $backPage
                ], layout: 'admin/layout');
                return;
            }
    
            // If there's an error, fall through to show form again
            $article = [
                'id' => $id,
                'title' => $title,
                'content' => $content,
                'is_published' => $isPublished,
                'allow_comments' => $allow_comments,
                'image_data' => $imageData,
            ];
    
            $data = [
                'article' => $article, 
                'error' => $error,
                'backPage' => $backPage
            ];
            render('admin/editArticles', $data, layout: 'admin/layout');
        } else {
            $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
            $stmt->execute([$id]);
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$article) die("Article not found.");
    
            // For GET requests, also pass the source to preserve it
            $data = [
                'article' => $article,
                'backPage' => $backPage,
                'source' => $backPage  // Pass the detected source
            ];
            render('admin/editArticles', $data, layout: 'admin/layout');
        }
    }

    public function deleteArticles() {
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role_id'], [2, 10])) {
            die("Access denied. Admins and Editors only.");
        }
    
        $db = new Database();
        $pdo = $db->connect();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
    
            if (!$id) {
                $_SESSION['error'] = "Missing article ID.";
            } else {
                // Check if the article exists
                $stmt = $pdo->prepare("SELECT id FROM articles WHERE id = ?");
                $stmt->execute([$id]);
                $article = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if (!$article) {
                    $_SESSION['error'] = "Article not found.";
                } else {
                    // Delete the article
                    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $_SESSION['success'] = "Article deleted successfully.";
                    } else {
                        $_SESSION['error'] = "Failed to delete article.";
                    }
                }
            }
    
            // Get the referring page and redirect back to it
            $referer = $_SERVER['HTTP_REFERER'] ?? '/PHP_MVC/public/admin/articles';
            header("Location: $referer");
            exit;
        }
    
        // If not a POST request, redirect to articles page as fallback
        header("Location: /PHP_MVC/public/admin/articles");
        exit;
    }

    public function createArticle() {
        // Check if user is logged in and has appropriate role (Author=1, Editor=2, Admin=10)
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role_id'], [1, 2, 10])) {
            die("Access denied. Authors, Editors, and Admins only.");
        }
    

    
        $db = new Database();
        $pdo = $db->connect();
    
        $error = '';
        $success = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            
            // Authors (role_id = 1) cannot publish articles directly - always set to 0
            if ($_SESSION['user']['role_id'] == 1) {
                $isPublished = 0; // Force unpublished for authors
            } else {
                $isPublished = isset($_POST['is_published']) ? 1 : 0; // Editors and Admins can choose
            }
            
            $allowComments = isset($_POST['allow_comments']) ? 1 : 0;
            $authorId = $_SESSION['user']['id'];
    
            // Validation
            if (empty($title)) {
                $error = "Title is required.";
            } elseif (empty($content)) {
                $error = "Content is required.";
            } else {
                $imageData = null;
                
                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageTmp = $_FILES['image']['tmp_name'];
                    $imageSize = filesize($imageTmp);
    
                    if ($imageSize > MAX_BLOB_SIZE) {
                        $error = "Image is too large. Max allowed is " . number_format(MAX_BLOB_SIZE) . " bytes. Please choose a smaller image.";
                    } else {
                        $imageData = file_get_contents($imageTmp);
                    }
                }
    
                // Insert article if no errors
                if (!$error) {
                    $sql = "INSERT INTO articles (title, content, author_id, is_published, allow_comments, image_data, created_at, updated_at) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
                    
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([$title, $content, $authorId, $isPublished, $allowComments, $imageData])) {
                        if ($_SESSION['user']['role_id'] == 1) {
                            $success = "Article created successfully and sent for review!";
                        } else {
                            $success = "Article created successfully!";
                        }
                        
                        // Clear form data after successful creation
                        $title = '';
                        $content = '';
                        $isPublished = 0;
                        $allowComments = 0;
                    } else {
                        $error = "Failed to create article. Please try again.";
                    }
                }
            }
        } else {
            // Default values for GET request
            $title = '';
            $content = '';
            $isPublished = 0;
            $allowComments = 1; // Default to allowing comments
        }
    
        $data = [
            'title' => $title,
            'content' => $content,
            'is_published' => $isPublished,
            'allow_comments' => $allowComments,
            'error' => $error,
            'success' => $success,
            'user_role' => $_SESSION['user']['role_id']
        ];
    
        render('admin/createArticle', $data, layout: 'admin/layout');
    }







}
?>
