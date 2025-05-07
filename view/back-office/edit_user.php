<?php
// Start output buffering
ob_start();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?page=admin_dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>
    
    <?php if (isset($error_message) && !empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($success_message) && !empty($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($user) && $user): ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-edit me-1"></i>
                Edit User: <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="card-body">
                <form id="editUserForm" action="index.php?page=edit_user&id=<?php echo $user['user_id']; ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                <div class="invalid-feedback">Please enter a username (at least 3 characters).</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active" <?php echo $user['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo $user['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                        <a href="index.php?page=admin_dashboard" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-key me-1"></i>
                Reset Password
            </div>
            <div class="card-body">
                <form id="resetPasswordForm" action="index.php?page=reset_user_password&id=<?php echo $user['user_id']; ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                <div class="invalid-feedback">Password must be at least 6 characters.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <div class="invalid-feedback">Passwords do not match.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-key me-1"></i> Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>User not found.
        </div>
        <a href="index.php?page=admin_dashboard" class="btn btn-primary">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation for edit user form
    const editUserForm = document.getElementById('editUserForm');
    
    if (editUserForm) {
        editUserForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate username
            const username = document.getElementById('username');
            if (username.value.trim().length < 3) {
                username.classList.add('is-invalid');
                isValid = false;
            } else {
                username.classList.remove('is-invalid');
            }
            
            // Validate email
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
    
    // Form validation for reset password form
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate new password
            const newPassword = document.getElementById('new_password');
            if (newPassword.value.length < 6) {
                newPassword.classList.add('is-invalid');
                isValid = false;
            } else {
                newPassword.classList.remove('is-invalid');
            }
            
            // Validate confirm password
            const confirmPassword = document.getElementById('confirm_password');
            if (confirmPassword.value !== newPassword.value) {
                confirmPassword.classList.add('is-invalid');
                isValid = false;
            } else {
                confirmPassword.classList.remove('is-invalid');
            }
            
            if (!isValid) {
                e.preventDefault();
            } else {
                if (!confirm('Are you sure you want to reset this user\'s password?')) {
                    e.preventDefault();
                }
            }
        });
    }
});
</script>

<?php
// Store the content in a variable
$content = ob_get_clean();

// Include the layout file which will use the $content variable
include __DIR__ . '/layout.php';
?>
