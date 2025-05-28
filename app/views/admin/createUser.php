<h2>Create New User</h2>

<?php if (!empty($error)): ?>
    <div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div style="color:green;"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<form method="post" action="">
    <div>
        <label>Username:</label><br>
        <input type="text" name="username" required>
    </div>

    <div>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" required>
    </div>

    <div>
        <label>Role:</label><br>
        <select name="role_id" required>
            <option value="">-- Select Role --</option>
            <?php foreach ($roleNames as $id => $role): ?>
                <option value="<?php echo $id; ?>"><?php echo $role; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>
    <button type="submit">Create User</button>
</form>
