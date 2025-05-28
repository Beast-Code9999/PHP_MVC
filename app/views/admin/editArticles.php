
<form method="post" enctype="multipart/form-data">
    <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>"></label>
    <br>

    <label>Content:<br>
        <textarea name="content" rows="10"><?= htmlspecialchars($article['content']) ?></textarea>
    </label>
    <br>

    <label>
        <input type="checkbox" name="is_published" <?= $article['is_published'] ? 'checked' : '' ?>> Published
    </label>
    <br>

    <label>
        <input type="checkbox" name="allow_comments" <?= $article['allow_comments'] ? 'checked' : '' ?>> Allow Comments
    </label>
    <br>

    <label>Upload New Image: <input type="file" name="image"></label>
    <?php if (!empty($article['image_data'])): ?>
    <p>Current Image:
        <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" width="150">
    </p>
    <?php endif; ?>

    <br>

    <button type="submit">Save Changes</button>
</form>
