<h1>Unpublished Articles - Admin Review</h1>

<?php foreach ($articles as $article): ?>
    <div style="background:#fff; padding:15px; margin-bottom:20px; border-radius:8px;">
        <h3><?= htmlspecialchars($article['title']) ?></h3>
        <p><strong>Author:</strong> <?= htmlspecialchars($article['username']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($article['created_at']) ?></p>
        <p><?= nl2br(htmlspecialchars(substr($article['content'], 0, 200))) ?>...</p>

        <?php if (!empty($article['image_data'])): ?>
            <p>
                <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" width="200" style="margin-top:10px; border-radius:4px;">
            </p>
        <?php endif; ?>

        <form action="/PHP_MVC/public/admin/editArticles" method="get" style="display:inline;">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
            <button type="submit">Edit</button>
        </form>

        <form action="/PHP_MVC/public/admin/deleteArticle" method="post" onsubmit="return confirm('Are you sure?');" style="display:inline;">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
            <button type="submit" style="background:red; color:white;">Delete</button>
        </form>
    </div>
<?php endforeach; ?>
