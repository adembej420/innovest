<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$additionalCss = ['css/admindashboard.css'];
ob_start();
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Create User</h2>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"> <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?> </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"> <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?> </div>
            <?php endif; ?>
            <form method="post" action="/gestion_userv2/gestion_user/public/index.php?page=register">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required minlength="6" autocomplete="new-password">
                </div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role:</label>
                        <select id="role" name="role" class="form-select">
                            <option value="user">Regular User</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';