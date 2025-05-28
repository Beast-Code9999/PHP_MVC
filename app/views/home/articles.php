<head>
    <link rel="stylesheet" href="<?php echo base_url('css/homeArticles.css')?>">
</head>


<div class="articles-container">
    <h1><?= $title ?></h1>
    <p class="intro-message"><?= $message ?></p>

    <?php if (!empty($articles)): ?>
        <div class="articles-grid">
            <?php foreach ($articles as $article): ?>
                <article class="article-card">
                    <h2 class="article-title"><?= htmlspecialchars($article['title']) ?></h2>
                    <div class="article-meta">
                        <span class="article-author">By <?= htmlspecialchars($article['author_name']) ?></span>
                        <span class="article-date"><?= date('F j, Y', strtotime($article['created_at'])) ?></span>
                    </div>
                    <div class="article-content">
                        <?php 
                        // Display a preview of the content (first 150 characters)
                        $preview = substr($article['content'], 0, 150);
                        echo htmlspecialchars($preview);
                        if (strlen($article['content']) > 150) echo '...';
                        ?>
                    </div>
                    <a href="/PHP_MVC/public/article?id=<?= $article['id'] ?>" class="read-more-btn">Read More</a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-articles">No articles have been published yet.</p>
    <?php endif; ?>
</div>