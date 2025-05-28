<head>
    <link rel="stylesheet" href="<?php echo base_url('css/homeArticleSingle.css')?>">
</head>

<div class="single-article-container">
    <div class="article-header">
        <h1 class="article-title"><?= htmlspecialchars($article['title']) ?></h1>
        
        <div class="article-meta">
            <div class="meta-left">
                <span class="article-author">By <?= htmlspecialchars($article['author_name'] ?? 'Unknown Author') ?></span>
                <span class="article-date">Published: <?= date('F j, Y', strtotime($article['created_at'])) ?></span>
                <?php if ($article['updated_at'] && $article['updated_at'] !== $article['created_at']): ?>
                    <span class="article-updated">Updated: <?= date('F j, Y', strtotime($article['updated_at'])) ?></span>
                <?php endif; ?>
            </div>
            
            <?php if ($article['allow_comments']): ?>
                <div class="comments-badge">Comments Enabled</div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if (!empty($article['image_data']) && $article['image_data'] !== 'NULL'): ?>
    <div class="article-image">
        <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" />
    </div>
    <?php endif; ?>
    
    <div class="article-content">
        <?= nl2br(htmlspecialchars($article['content'])) ?>
    </div>
    
    <div class="article-actions">
        <a href="/PHP_MVC/public/articles" class="back-btn">← Back to Articles</a>
        
        <?php if ($article['allow_comments']): ?>
            <div class="comments-section">
                <h3>Comments</h3>
                <!-- You can add a comments implementation here in the future -->
                <p class="comments-placeholder">Comments feature coming soon!</p>
            </div>
        <?php endif; ?>
    </div>
</div>