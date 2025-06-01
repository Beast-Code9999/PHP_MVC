<head>
    <link rel="stylesheet" href="<?php echo base_url('css/adminUpdateUser.css'); ?>">
</head>

<h2>Update User Details</h2>

<?php if ($error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color: green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post" action="/PHP_MVC/public/admin/updateUser?id=<?= urlencode($user['id']) ?>">
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
<a href="/PHP_MVC/public/admin/userlist">← Back to User List</a>

