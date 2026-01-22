<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Login</h2>

<form method="POST" action="index.php?page=login&action=proses">
    <div>
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

<?php require __DIR__ . '/layouts/footer.php'; ?>
