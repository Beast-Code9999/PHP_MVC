<head>
   <link rel="stylesheet" href="<?php echo base_url('css/adminEditArticle.css'); ?>">
   <script src="<?php echo base_url('js/imagePreview.js'); ?>"></script>
</head>

<?php if (!empty($success)): ?>
   <div style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:15px;">
       <?= htmlspecialchars($success) ?>
   </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
   <div style="padding:10px; background:#f8d7da; color:#721c24; border-radius:5px; margin-bottom:15px;">
       <?= htmlspecialchars($error) ?>
   </div>
<?php endif; ?>

<div>
   <?php if ($_SESSION['user']['role_id'] == 1): ?>
       <a href="<?php echo base_url('admin/dashboard') ?>" class="back-to-articles">
           ← Back to Dashboard
       </a>
   <?php else: ?>
       <a href="<?php echo base_url($backPage) ?>" class="back-to-articles">
           ← Back to <?php echo strpos($backPage, 'review') !== false ? 'Review Articles' : 'Articles' ?>
       </a>
   <?php endif; ?>
</div>

<form method="post" enctype="multipart/form-data">
   <input type="hidden" name="source" value="<?= $backPage ?>">

   <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>"></label>
   <br>

   <label>Content:<br>
       <textarea name="content" rows="10"><?= htmlspecialchars($article['content']) ?></textarea>
   </label>
   <br>

   <label>
       <input type="checkbox" name="is_published" <?= $article['is_published'] ? 'checked' : '' ?>> Published
   </label>
   <br>

   <label>
       <input type="checkbox" name="allow_comments" <?= $article['allow_comments'] ? 'checked' : '' ?>> Allow Comments
   </label>
   <br>
    
   <label>Tags:</label>
   <div>
       <?php foreach ($tags as $tag): ?>
           <label style="margin-right: 10px;">
               <input type="checkbox" name="tags[]" value="<?= $tag['tag_id'] ?>" <?= (isset($selected_tags) && in_array($tag['tag_id'], $selected_tags)) ? 'checked' : '' ?>>
               <?= htmlspecialchars($tag['tag_name']) ?>
           </label>
       <?php endforeach; ?>
   </div>
   <div class="form-text">Select one or more tags for this article.</div>

<br>

   <label>Upload New Image:</label>
   <div style="display: flex; align-items: center; gap: 10px; margin-top: 6px;">
       <input type="file" name="image" id="imageInput" accept="image/*" style="flex: 1;">
       <button type="button" id="clearNewImage" style="display: none; background: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 14px; white-space: nowrap;">Clear Selected</button>
   </div>

   <div id="imagePreview" style="display: none; margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 8px; border: 1px solid #e5e7eb;">
       <p style="margin: 0 0 10px 0; font-weight: 500; color: #374151;">Preview:</p>
       <img id="previewImg" src="" width="150" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
   </div>

   <?php if (!empty($article['image_data'])): ?>
   <div id="currentImageSection" style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 8px; border: 1px solid #e5e7eb;">
       <p style="margin: 0 0 10px 0; font-weight: 500; color: #374151;">Current Image:</p>
       <img src="data:image/jpeg;base64,<?= base64_encode($article['image_data']) ?>" width="150" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
       <br>
       <button type="button" id="removeCurrentImage" style="background: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 14px;">Remove Current Image</button>
   </div>
   <input type="hidden" name="remove_image" id="removeImageFlag" value="0">
   <?php endif; ?>
   <br>

   <button type="submit" name="save_edit">Save Changes</button>
   <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1): ?>
       <button type="submit" name="save_draft" value="1" style="background:#6c757d; color:white; margin-left:10px;">Save as Draft</button>
   <?php endif; ?>
</form>