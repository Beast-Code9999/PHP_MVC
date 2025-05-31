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
        <h1>Admin Dashboard</h1>
        <nav class="admin-nav">

            <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            <a href="<?php echo base_url('admin/userlist'); ?>">Users</a>
            <a href="<?php echo base_url('admin/reviewArticles'); ?>">Pending</a>
            <a href="<?php echo base_url('admin/articles'); ?>">Articles</a>
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
