<head>
    <link rel="stylesheet" href="<?php echo base_url('css/homeArticleSingle.css')?>">
</head>

<div class="single-article-container">
    <div class="article-header">
        <h1 class="article-title"><?= htmlspecialchars($article['title']) ?></h1>
        
        <div class="article-tags" style="margin: 12px 0;">
            <strong>Tags:</strong>
            <?php if (!empty($article['tags'])): ?>
                <?php foreach ($article['tags'] as $tag): ?>
                    <a href="/PHP_MVC/public/articles?tags[]=<?= $tag['tag_id'] ?>" class="badge bg-primary" style="margin-right:5px; text-decoration:none; color:white;">
                        <?= htmlspecialchars($tag['tag_name']) ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <span style="color: #888;">None</span>
            <?php endif; ?>
        </div>
        
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
    
    <div class="article-image">
        <?php if (!empty($article['image_data']) && $article['image_data'] !== 'NULL' && $article['image_data'] !== null): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" />
        <?php else: ?>
            <img src="<?= base_url('images/default-article.jpg') ?>" alt="Default article image" />
        <?php endif; ?>
    </div>
    
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
                                <?php
                                    $isEditing = isset($_GET['edit_comment']) && $_GET['edit_comment'] == $comment['id'];
                                ?>
                                <?php if ($isEditing && isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                                    <form action="<?= base_url('edit-comment') ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                        <textarea name="content" rows="2" required><?= htmlspecialchars($comment['content']) ?></textarea>
                                        <button type="submit">Save</button>
                                        <a href="<?= base_url('article?id=' . $article['id']) ?>">Cancel</a>
                                    </form>
                                <?php else: ?>
                                    <?= nl2br(htmlspecialchars($comment['content'])) ?>
                                    <div class="comment-date"><?= date('F j, Y H:i', strtotime($comment['created_at'])) ?></div>
                                    <?php if (
                                        isset($_SESSION['user']) && 
                                        (
                                            $_SESSION['user']['id'] == $comment['user_id'] || 
                                            in_array($_SESSION['user']['role_id'] ?? 0, [2, 10])
                                        )
                                    ): ?>
                                        <form action="<?= base_url('delete-comment') ?>" method="POST" style="display:inline;">
                                            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                            <button type="submit" onclick="return confirm('Delete this comment?')">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                                        <form action="<?= base_url('article') ?>" method="GET" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                            <input type="hidden" name="edit_comment" value="<?= $comment['id'] ?>">
                                            <button type="submit" style="margin-left:10px;">Edit</button>
                                        </form>
                                    <?php endif; ?>
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