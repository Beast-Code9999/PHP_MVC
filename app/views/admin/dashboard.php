<head>
    <link rel="stylesheet" href="<?php echo base_url('css/adminDashboard.css')?>">
</head>

<div class="dashboard-section">
    <?php if ($roleId == 10): // Admin ?>
        <div class="section-box">
            <h2>User Management</h2>
            <a href="/PHP_MVC/public/admin/userlist" class="pill-button">Users</a>
        </div>
    <?php endif; ?>

    <?php if (in_array($roleId, [10, 2])): // Admin & Editor ?>
        <div class="section-box">
            <h2>Pending Tasks</h2>
            <a href="/PHP_MVC/public/admin/articles/pending" class="pill-button">Pending Articles</a>
        </div>
    <?php endif; ?>

    <div class="section-box">
        <h2>Articles</h2>
        <a href="/PHP_MVC/public/admin/articles/published" class="pill-button">All Articles</a>
    </div>
</div>
