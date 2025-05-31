<head>
    <link rel="stylesheet" href="<?php echo base_url('css/articlesList.css')?>">
    <style>
        .back-to-dashboard {
            display: inline-block;
            margin: 2rem 0 1.5rem 2rem;
            padding: 0.6rem 1.5rem;
            background: linear-gradient(90deg, #7c5e99 0%, #a088b6 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.18s, transform 0.15s;
            box-shadow: 0 2px 8px 0 rgba(124, 94, 153, 0.08);
            cursor: pointer;
        }
        .back-to-dashboard:hover {
            background: linear-gradient(90deg, #a088b6 0%, #7c5e99 100%);
            transform: translateY(-2px) scale(1.03);
        }
    </style>
</head>

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
