<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin Dashboard'; ?></title>
    <link rel="stylesheet" href="/PHP_MVC/public/css/admin.css">
</head>
<body>
    <header>
        <?php
        $roleName = 'Dashboard';
        $username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '';
        if (isset($_SESSION['user']['role_id'])) {
            if ($_SESSION['user']['role_id'] == 1) {
                $roleName = 'Journalist Dashboard';
            } elseif ($_SESSION['user']['role_id'] == 2) {
                $roleName = 'Editor Dashboard';
            } elseif ($_SESSION['user']['role_id'] == 10) {
                $roleName = 'Admin Dashboard';
            }
        }
        ?>
        <h1><?= $roleName ?></h1>
        <?php if ($username): ?>
            <div class="admin-user-info">
                <span class="user-icon">👤</span>
                <span class="user-name"><?= htmlspecialchars($username) ?></span>
            </div>
        <?php endif; ?>
        <nav class="admin-nav">
            <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            <a href="<?php echo base_url(''); ?>">Home</a>
            <a href="<?php echo base_url('articles'); ?>">Articles</a>
            <a href="<?php echo base_url('user/logout'); ?>">Logout</a>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        &copy; <?= date("Y") ?> Admin Page.
    </footer>
</body>
</html>
