<h2>Admin Dashboard – User List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $roleNames[$user['role_id']] ?? 'Unknown' ?></td>
            <td>
                <?php if ($currentUserId != $user['id']): ?>
                    <a href="/PHP_MVC/public/admin/updateUser?id=<?= $user['id'] ?>">Update</a>
                    <a class="btn-delete" href="/admin/delete_user?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                <?php else: ?>
                    (You)
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<style>
    body { font-family: Arial; padding: 2rem; background: #f0f0f0; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background-color: #eee; }
    h2 { margin-bottom: 1rem; }
    .btn-delete, .btn-update {
        padding: 5px 10px;
        text-decoration: none;
        margin-right: 5px;
    }
    .btn-delete { color: red; }
    .btn-update { color: blue; }
</style>
