<head>
    <link rel="stylesheet" href="<?php echo base_url('css/homeArticles.css')?>">
</head>


<div class="articles-container">
    <h1><?= $title ?></h1>

    <?php if (!empty($message)): ?>
        <p class="intro-message"><?= $message ?></p>
    <?php endif; ?>

    <form method="get" class="filter-tags mb-4">
        <div><strong>Filter by tags:</strong></div>
        <div style="margin-bottom: 1em;">
            <?php foreach ($allTags as $tag): ?>
                <label>
                    <input type="checkbox" name="tags[]" value="<?= $tag['tag_id'] ?>" <?= in_array($tag['tag_id'], $selectedTags ?? []) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($tag['tag_name']) ?>
                </label>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        </div>
    </form>

    <?php if (!empty($articles)): ?>
        <div class="articles-grid">
            <?php foreach ($articles as $article): ?>
                <article class="article-card">
                    <h2 class="article-title"><?= htmlspecialchars($article['title']) ?></h2>
                    <div class="article-meta">
                        <span class="article-author">By <?= htmlspecialchars($article['author_name']) ?></span>
                        <span class="article-date"><?= date('F j, Y', strtotime($article['created_at'])) ?></span>
                    </div>
                    <div class="article-tags" style="margin-bottom: 8px;">
                        <?php if (!empty($article['tags'])): ?>
                            <span>Tags:
                                <?php foreach ($article['tags'] as $tag): ?>
                                    <a href="/PHP_MVC/public/articles?tags[]=<?= $tag['tag_id'] ?>" class="badge bg-primary" style="margin-right:5px; text-decoration:none; color:white;">
                                        <?= htmlspecialchars($tag['tag_name']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </span>
                        <?php endif; ?>
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