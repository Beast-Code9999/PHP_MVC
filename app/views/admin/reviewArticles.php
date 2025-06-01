<head>
    <link rel="stylesheet" href="<?php echo base_url('css/adminReviewArticles.css'); ?>">
</head>

<div>
    <a href="<?php echo base_url('admin/dashboard') ?>" class="back-to-dashboard">
        ← Back to Dashboard
    </a>
</div>

<?php if (!empty($success)): ?>
    <div style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:15px;">
        <?= htmlspecialchars($success) ?>
    </div>
<?php elseif (!empty($error)): ?>
    <div style="padding:10px; background:#f8d7da; color:#721c24; border-radius:5px; margin-bottom:15px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<h1>Unpublished Articles - Admin Review</h1>

<?php foreach ($articles as $article): ?>
    <div class="admin-article-card">
        <h3><?= htmlspecialchars($article['title']) ?></h3>
        <p><strong>Author:</strong> <?= htmlspecialchars($article['username']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($article['created_at']) ?></p>
        <p><?= nl2br(htmlspecialchars(substr($article['content'], 0, 200))) ?>...</p>

        <?php if (!empty($article['image_path']) && file_exists($article['image_path'])): ?>
            <p>
                <img src="<?= htmlspecialchars($article['image_path']) ?>" width="200" style="margin-top:10px; border-radius:4px;">
            </p>
        <?php elseif (!empty($article['image_data'])): ?>
            <p>
                <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" width="200" style="margin-top:10px; border-radius:4px;">
            </p>
        <?php endif; ?>

        <form action="/PHP_MVC/public/admin/editArticles" method="get" style="display:inline;">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
            <button type="submit" class="btn-update">Edit</button>
        </form>

        <form action="/PHP_MVC/public/admin/deleteArticles" method="post" onsubmit="return confirm('Are you sure you want to delete this article?');" style="display:inline;">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
            <button type="submit" class="btn-delete">Delete</button>
        </form>

        </form>
    </div>
<?php endforeach; ?>

