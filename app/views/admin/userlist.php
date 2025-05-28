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
                    <a class="btn-update" href="/PHP_MVC/public/admin/updateUser?id=<?= $user['id'] ?>">Update</a>
                    <a class="btn-delete" 
                        href="/PHP_MVC/public/admin/deleteUser?id=<?= $user['id'] ?>" 
                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                <?php else: ?>
                    (You)
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

