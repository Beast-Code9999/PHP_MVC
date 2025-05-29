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

                <?php if (!empty($comments)): ?>
                    <ul class="comments-list">
                        <?php foreach ($comments as $comment): ?>
                            <li>
                                <strong><?= htmlspecialchars($comment['username']) ?>:</strong>
                                <?= nl2br(htmlspecialchars($comment['content'])) ?>
                                <div class="comment-date"><?= date('F j, Y H:i', strtotime($comment['created_at'])) ?></div>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                                    <form action="<?= base_url('delete-comment') ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                        <button type="submit" onclick="return confirm('Delete this comment?')">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No comments yet.</p>
                <?php endif; ?>

                <?php if (isset($_SESSION['user'])): ?>
                    <form action="<?= base_url('post-comment') ?>" method="POST" class="comment-form">
                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                        <textarea name="content" rows="3" required placeholder="Write your comment..."></textarea>
                        <button type="submit">Post Comment</button>
                    </form>
                <?php else: ?>
                    <p><a href="<?= base_url('user/login') ?>">Log in</a> to post a comment.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>