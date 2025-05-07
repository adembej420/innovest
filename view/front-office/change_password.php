<?php
// Start output buffering
ob_start();

// Include the image CAPTCHA functions
require_once __DIR__ . '/../../includes/image_captcha.php';
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-shield-lock me-2"></i>Change Password</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error_message) && !empty($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($success_message) && !empty($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?page=change_password" method="POST" id="changePasswordForm">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Password must be at least 8 characters long.</div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirm_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Image CAPTCHA Security Check -->
                        <?php echo generateImageCaptchaHtml(); ?>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php?page=userdashboard" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-shield-check me-1"></i> Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // Form validation
    const form = document.getElementById('changePasswordForm');
    form.addEventListener('submit', function(e) {
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        let isValid = true;
        let errorMessage = '';

        if (!currentPassword) {
            errorMessage = 'Please enter your current password.';
            isValid = false;
        } else if (!newPassword) {
            errorMessage = 'Please enter a new password.';
            isValid = false;
        } else if (newPassword.length < 8) {
            errorMessage = 'New password must be at least 8 characters long.';
            isValid = false;
        } else if (newPassword !== confirmPassword) {
            errorMessage = 'New passwords do not match.';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            alert(errorMessage);
        }
    });
});
</script>

<?php
// Store the content in a variable
$content = ob_get_clean();

// Include the layout file which will use the $content variable
include __DIR__ . '/user_layout.php';
?>
