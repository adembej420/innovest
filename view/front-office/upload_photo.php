<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Upload Profile Photo</h4>
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

                    <form action="index.php?page=upload_photo" method="POST" enctype="multipart/form-data">
                        <div class="text-center mb-4">
                            <div class="profile-preview-container">
                                <?php
                                $profilePhoto = $user['profile_photo'] ?? $_SESSION['profile_photo'] ?? '/userv2/gestion_user/assets/img/default-avatar.svg';
                                ?>
                                <img id="profile-preview" src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile Preview" class="profile-preview">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Select Image</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*" required>
                            <div class="form-text">Supported formats: JPG, PNG, GIF. Max size: 5MB.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cloud-upload-fill me-2"></i> Upload Photo
                            </button>
                            <a href="index.php?page=userdashboard" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-preview-container {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    border-radius: 50%;
    border: 3px solid #0d6efd;
    background-color: #f8f9fa;
}

.profile-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePreview = document.getElementById('profile-preview');

    profilePhotoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                profilePreview.src = e.target.result;
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
