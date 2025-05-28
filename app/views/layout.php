<!-- Frontend layout -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/layout.css') ?>">
</head>
<body>
    <!-- Header/Navigation -->
    <header class="header">
        <div class="nav-container">
            <div class="nav-left">
                <h1 class="logo">NEWS</h1>
                <div class="search-box">
                    <input type="text" placeholder="Search articles..." class="search-input">
                    <span class="search-icon">🔍</span>
                </div>
            </div>
            <nav class="nav-right">
                <a href="<?= base_url() ?>" class="nav-link">Home</a>
                <a href="<?= base_url('articles') ?>" class="nav-link">Articles</a>
                <a href="<?= base_url('about') ?>" class="nav-link">About Us</a>

                <?php if (isset($_SESSION['user'])): ?>
                    <!-- User is logged in - show logout -->
                    <a href="<?php echo base_url('user/logout'); ?>" class="login-btn">Logout</a>
                <?php else: ?>
                    <!-- User is not logged in - show login -->
                    <a href="/PHP_MVC/public/user/login" class="login-btn">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
        <?= $content; ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <h3 class="footer-logo">NEWS</h3>
                <div class="social-icons">
                    <a href="#" class="social-icon">🐦</a>
                    <a href="#" class="social-icon">📷</a>
                    <a href="#" class="social-icon">📘</a>
                    <a href="#" class="social-icon">⚫</a>
                </div>
            </div>
            
            <div class="footer-center">
                <div class="footer-links">
                    <a href="<?= base_url('about') ?>" class="footer-link">About Us</a>
                    <a href="<?= base_url('contact') ?>" class="footer-link">Contact Us</a>
                    <a href="#" class="footer-link">Legal</a>
                </div>
            </div>
            
            <div class="footer-right">
                <div class="newsletter">
                    <span class="newsletter-text">Subscribe to weekly news?</span>
                    <div class="newsletter-form">
                        <input type="email" placeholder="Email address" class="newsletter-input">
                        <button class="newsletter-btn">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
