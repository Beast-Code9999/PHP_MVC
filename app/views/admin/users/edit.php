<h2>Edit User (Admin Panel)</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color: green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <label>New Password (leave blank to keep current):</label><br>
    <input type="text" name="password" placeholder="Enter new password"><br><br>

    <label>Role:</label><br>
    <select name="role_id">
        <?php foreach ($roleNames as $id => $name): ?>
            <option value="<?= $id ?>" <?= $id == $user['role_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($name) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Update User">
</form>

<br>
<a href="<?= base_url('admin/user/list') ?>">← Back to User List</a>
