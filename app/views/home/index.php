<head>
    <link rel="stylesheet" href="<?php echo base_url('css/home.css'); ?>">
</head>

<!-- Recent Articles Section -->
<section class="recent-articles-section">
    <div class="container">
        <h2 class="section-title">Latest Articles</h2>
        
        <?php if (!empty($recentArticles)): ?>
            <div class="articles-grid">
                <?php foreach ($recentArticles as $article): ?>
                    <article class="article-card">
                        <div class="article-image">
                            <?php if (!empty($article['image_data']) && $article['image_data'] !== 'NULL'): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                            <?php else: ?>
                                <img src="<?= base_url('images/default-article.jpg') ?>" alt="Default article image">
                            <?php endif; ?>
                        </div>
                        
                        <div class="article-content">
                            <h3 class="article-title">
                                <a href="<?= base_url('article?id=' . $article['id']) ?>">
                                    <?= htmlspecialchars($article['title']) ?>
                                </a>
                            </h3>
                            
                            <div class="article-meta">
                                <span class="author">By <?= htmlspecialchars($article['author_name']) ?></span>
                                <span class="date"><?= date('M j, Y', strtotime($article['created_at'])) ?></span>
                            </div>
                            
                            <p class="article-excerpt">
                                <?= htmlspecialchars(substr($article['content'], 0, 120)) ?>...
                            </p>
                            
                            <a href="<?= base_url('article?id=' . $article['id']) ?>" class="read-more">
                                Read More →
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            
            <div class="view-all">
                <a href="<?= base_url('articles') ?>" class="btn-view-all">View All Articles</a>
            </div>
        <?php else: ?>
            <p class="no-articles">No articles available yet.</p>
        <?php endif; ?>
    </div>
</section>