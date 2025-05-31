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

<!-- Back to Dashboard Button -->
<a href="/PHP_MVC/public/admin/dashboard">&larr; Back to Dashboard</a>


<style>
.back-to-dashboard {
    display: inline-block;
    margin: 2rem 0 1.5rem 2rem;
    padding: 0.6rem 1.5rem;
    background: linear-gradient(90deg, #7c5e99 0%, #a088b6 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.18s, transform 0.15s;
    box-shadow: 0 2px 8px 0 rgba(124, 94, 153, 0.08);
    cursor: pointer;
}
.back-to-dashboard:hover {
    background: linear-gradient(90deg, #a088b6 0%, #7c5e99 100%);
    transform: translateY(-2px) scale(1.03);
}

.btn-update,
.btn-delete {
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 4px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-block;
    transition: background-color 0.2s ease;
}
.btn-update {
    background-color: #1976d2;
    color: #fff;
}
.btn-update:hover {
    background-color: #1565c0;
}
.btn-delete {
    background-color: #e57373;
    color: #fff;
}
.btn-delete:hover {
    background-color: #c62828;
}

/* Article Card */
.admin-article-card {
    background: #fff;
    padding: 18px;
    margin-bottom: 22px;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(124, 94, 153, 0.07);
}

@media (max-width: 700px) {
    .back-to-dashboard {
        margin-left: 0.5rem;
        padding: 0.5rem 1rem;
        font-size: 0.95rem;
    }
    .admin-article-card {
        padding: 10px;
    }
}
</style>
