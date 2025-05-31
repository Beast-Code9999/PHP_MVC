<div>
    <a href="<?php echo base_url('admin/dashboard') ?>" class="back-to-dashboard">
        ← Back to Dashboard
    </a>
</div>

<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Articles Pending Review</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pending_articles)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No articles pending review</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pending_articles as $article): ?>
                                <tr>
                                    <td><?= $article['id'] ?></td>
                                    <td><?= htmlspecialchars($article['title']) ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($article['created_at'])) ?></td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td><?= date('Y-m-d H:i', strtotime($article['updated_at'])) ?></td>
                                    <td>
                                        <?php if (
                                            ($_SESSION['user']['role_id'] == 1 && $_SESSION['user']['id'] == $article['author_id']) // Author can delete own
                                            || in_array($_SESSION['user']['role_id'], [2, 10]) // Editor/Admin can delete all
                                        ): ?>
                                        <form action="/PHP_MVC/public/admin/deleteArticles" method="post" style="display:inline;" onsubmit="return confirm('Delete this article?');">
                                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        <?php endif; ?>
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
