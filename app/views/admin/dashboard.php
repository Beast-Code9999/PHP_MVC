<head>
    <link rel="stylesheet" href="<?php echo base_url('css/adminDashboard.css')?>">
</head>

<div class="dashboard-section">
    <?php if ($roleId == 1): // Journalist only ?>
        <h1 style="margin-bottom: 24px; color: #7c5e99;">Journalist Dashboard</h1>
    <?php elseif ($roleId == 2): // Editor ?>
        <h1 style="margin-bottom: 24px; color: #7c5e99;">Editor Dashboard</h1>
    <?php elseif ($roleId == 10): // Admin ?>
        <h1 style="margin-bottom: 24px; color: #7c5e99;">Admin Dashboard</h1>
    <?php endif; ?>

    <?php if ($roleId == 10): // Admin ?>
        <div class="section-box">
            <h2>User Management</h2>
            <a href="/PHP_MVC/public/admin/userlist" class="pill-button">Users</a>
        </div>
    <?php endif; ?>

    <?php if (in_array($roleId, [10, 2])): // Admin & Editor ?>
        <div class="section-box">
            <h2>Pending Tasks</h2>
            <a href="/PHP_MVC/public/admin/reviewArticles" class="pill-button">Pending Articles</a>
        </div>
    <?php endif; ?>

    <?php if ($roleId != 1): // Hide from journalists ?>
        <div class="section-box">
            <h2>Articles</h2>
            <a href="/PHP_MVC/public/admin/articles" class="pill-button">All Articles</a>
        </div>
    <?php endif; ?>

    <?php if (in_array($roleId, [1, 10])): // Journalist & Admin ?>
        <div class="section-box">
            <h2>Your Articles</h2>
            <a href="/PHP_MVC/public/admin/yourArticles" class="pill-button">Your Articles</a>
        </div>
    <?php endif; ?>

    <?php if ($roleId == 1): // Journalist only ?>
        <div class="section-box">
            <h2>Pending Review</h2>
            <a href="/PHP_MVC/public/admin/pendingArticles" class="pill-button">Pending Articles</a>
        </div>
    <?php endif; ?>

    <?php if ($roleId == 1): // Journalist only ?>
        <div class="section-box">
            <h2>Continue Editing Drafts</h2>
            <a href="/PHP_MVC/public/admin/drafts" class="pill-button">Your Drafts</a>
        </div>
    <?php endif; ?>
</div>
