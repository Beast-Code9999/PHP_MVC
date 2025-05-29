<head>
    <link rel="stylesheet" href="<?php echo base_url('css/articlesList.css')?>">
</head>

<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Articles</h2>
        </div>
        <div class="col-auto">
            <a href="<?php echo base_url('admin/createArticle')?>" class="btn btn-primary">Create Article</a>
        </div>
    </div>
    
    <!-- Articles Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th>Comments</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($articles)): ?>
                            <tr>
                                <td colspan="9" class="text-center">No articles found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><?= $article['id'] ?></td>
                                    <td><?= htmlspecialchars($article['title']) ?></td>
                                    <td>
                                        <?= htmlspecialchars(substr($article['content'], 0, 50)) ?>
                                        <?= strlen($article['content']) > 50 ? '...' : '' ?>
                                    </td>
                                    <td><?= htmlspecialchars($article['author_name']) ?></td>
                                    <td>
                                        <span class="badge <?= $article['is_published'] ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $article['is_published'] ? 'Yes' : 'No' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $article['allow_comments'] ? 'bg-info' : 'bg-secondary' ?>">
                                            <?= $article['allow_comments'] ? 'Allowed' : 'Disabled' ?>
                                        </span>
                                    </td>
                                    <td><?= date('Y-m-d H:i', strtotime($article['created_at'])) ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($article['updated_at'])) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="/PHP_MVC/public/admin/editArticles" method="get" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                            </form>
                                            <form action="/PHP_MVC/public/admin/deleteArticles" method="post" style="display:inline;" onsubmit="return confirm('Delete this article?');">
                                                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>