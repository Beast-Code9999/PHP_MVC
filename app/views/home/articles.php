<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
    <link rel="stylesheet" href="/public/css/articles.css">
</head>
<body>
    <h1>Articles</h1>
    <?php if (!empty($articles) && is_array($articles)): ?>
        <ul>
            <?php foreach ($articles as $article): ?>
                <li>
                    <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                    <small>Published on: <?php echo htmlspecialchars($article['created_at']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No articles found.</p>
    <?php endif; ?>
</body>
</html>