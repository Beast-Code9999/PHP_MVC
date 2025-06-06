<head>
    <link rel="stylesheet" href="<?php echo base_url('css/articlesList.css')?>">
</head>

<div>
    <a href="<?php echo base_url('admin/dashboard') ?>" class="back-to-dashboard">
        ← Back to Dashboard
    </a>
</div>

<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Your Drafts</h2>
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
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($drafts)): ?>
                            <tr>
                                <td colspan="4" class="text-center">No drafts found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($drafts as $draft): ?>
                                <tr>
                                    <td><?= $draft['id'] ?></td>
                                    <td><?= htmlspecialchars($draft['title']) ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($draft['updated_at'])) ?></td>
                                    <td>
                                        <form action="/PHP_MVC/public/admin/editArticles" method="get" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $draft['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Continue Editing</button>
                                        </form>
                                        <?php if (
                                            ($_SESSION['user']['role_id'] == 1 && $_SESSION['user']['id'] == $draft['author_id']) // Author can delete own
                                            || in_array($_SESSION['user']['role_id'], [2, 10]) // Editor/Admin can delete all
                                        ): ?>
                                        <form action="/PHP_MVC/public/admin/deleteArticles" method="post" style="display:inline;" onsubmit="return confirm('Delete this draft?');">
                                            <input type="hidden" name="id" value="<?= $draft['id'] ?>">
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
