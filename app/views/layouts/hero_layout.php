<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'News Website'; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('css/hero.css')?>">
</head>
<body>
    <!-- Header/Navigation -->
    <header class="header">
        <div class="nav-container">
            <div class="nav-left">
                <div class="logo">
                    <a href="<?= base_url('/') ?>">
                        <span style="font-weight:bold; color:#fff;">NEWS</span>
                    </a>
                </div>
                <div class="search-box">
                    <form action="<?= base_url('articles') ?>" method="get" style="display:flex;">
                        <input type="text" name="search" placeholder="Search articles..." class="search-input" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="search-icon" style="background:none;border:none;cursor:pointer;">🔍</button>
                    </form>
                </div>
            </div>
            <nav class="nav-right">
                <a href="<?php echo base_url('/'); ?>" class="nav-link">Home</a>
                <a href="/PHP_MVC/public/articles" class="nav-link">Articles</a>
                <a href="<?php echo base_url('/about'); ?>" class="nav-link">About Us</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if (in_array($_SESSION['user']['role_id'], [1,2,10])): ?>
                        <a href="/PHP_MVC/public/admin/dashboard" class="nav-user" style="color:#fff; margin-right:1rem; text-decoration:none;">
                            👤 <?= htmlspecialchars($_SESSION['user']['username']) ?>
                        </a>
                    <?php else: ?>
                        <span style="color: #fff; margin-right: 1rem;">
                            👤 <?= htmlspecialchars($_SESSION['user']['username']) ?>
                        </span>
                    <?php endif; ?>
                    <a href="<?php echo base_url('user/logout'); ?>" class="login-btn">Logout</a>
                <?php else: ?>
                    <a href="/PHP_MVC/public/user/login" class="login-btn">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title"><?php echo isset($hero_title) ? $hero_title : 'Lorem Ipsum Sit Amet'; ?></h1>
            <p class="hero-description">
                <?php echo isset($hero_description) ? $hero_description : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris'; ?>
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
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