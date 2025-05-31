<head>
    <link rel="stylesheet" href="<?php echo base_url('css/createArticle.css')?>">
</head>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Article</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="<?= htmlspecialchars($title ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required><?= htmlspecialchars($content ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Article Image (Optional)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="form-text">Maximum file size: 65KB</div>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <div>
                                <?php foreach ($tags as $tag): ?>
                                    <label style="margin-right: 10px;">
                                        <input type="checkbox" name="tags[]" value="<?= $tag['tag_id'] ?>" <?= (isset($selected_tags) && in_array($tag['tag_id'], $selected_tags)) ? 'checked' : '' ?>>
                                        <?= htmlspecialchars($tag['tag_name']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-text">Select one or more tags for this article.</div>
                        </div>

                        <div class="row">
                            <?php if ($user_role != 1): // Only show publish option for Editors/Admins ?>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="is_published" name="is_published" 
                                           <?= isset($is_published) && $is_published ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_published">
                                        Publish Article Immediately
                                    </label>
                                </div>
                            </div>
                            <?php elseif ($user_role == 1): ?>
                            <div class="col-md-6">
                                <div class="alert alert-info mb-3">
                                    <small><strong>Note:</strong> As an Author, your articles will be sent for admin/editor review before publishing.</small>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="allow_comments" name="allow_comments" 
                                           <?= isset($allow_comments) && $allow_comments ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="allow_comments">
                                        Allow Comments
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/PHP_MVC/public/admin/articles" class="btn btn-secondary">Back to Articles</a>
                            <button type="submit" class="btn btn-primary">Create Article</button>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1): ?>
                                <button type="submit" name="save_draft" value="1" class="btn btn-secondary" style="margin-left:10px;">Save as Draft</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>