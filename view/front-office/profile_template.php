<div class="container profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <h1>My Profile</h1>
        <p>Manage your account information and settings</p>
    </div>

    <?php if (isset($error_message) && !empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success_message) && !empty($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Left Column - Sidebar Navigation -->
        <div class="col-lg-3 mb-4">
            <!-- Profile Sidebar -->
            <div class="profile-sidebar">
                <div class="sidebar-header">
                    <h3><i class="bi bi-person-circle me-2"></i>User Profile</h3>
                </div>

                <!-- User Photo and Name -->
                <div class="text-center py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="profile-photo-container">
                        <div class="profile-photo mx-auto">
                            <img src="<?php echo htmlspecialchars($profile_photo); ?>" alt="Profile Photo" id="sidebarProfilePhoto">
                            <a href="index.php?page=upload_photo" class="edit-photo" title="Change Profile Photo">
                                <i class="bi bi-camera-fill"></i>
                            </a>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-0"><?php echo htmlspecialchars($username); ?></h5>
                    <span class="badge bg-primary mt-2"><?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? 'user')); ?></span>
                </div>

                <!-- User Status and Last Online -->
                <div class="user-info-section">
                    <div class="user-status">
                        <div class="status-indicator status-online"></div>
                        <div class="status-text">Online</div>
                        <div class="status-help" title="Click to change status">
                            <i class="bi bi-info-circle"></i>
                        </div>
                    </div>

                    <div class="last-online">
                        <i class="bi bi-clock-history"></i>
                        Last online: <?php echo htmlspecialchars($last_online ?? date('M d, Y H:i')); ?>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="sidebar-section">
                    <div class="sidebar-section-header">
                        <i class="bi bi-gear-fill me-2"></i>Account Settings
                    </div>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="index.php?page=profile" class="active">
                                <i class="bi bi-person-badge"></i>
                                Profile Overview
                            </a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                                <i class="bi bi-pencil-square"></i>
                                Edit Personal Info
                            </a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key"></i>
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=upload_photo">
                                <i class="bi bi-camera"></i>
                                Update Photo
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Navigation Links - Quick Access -->
                <div class="sidebar-section">
                    <div class="sidebar-section-header">
                        <i class="bi bi-lightning-fill me-2"></i>Quick Access
                    </div>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="index.php?page=userdashboard">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=activity">
                                <i class="bi bi-activity"></i>
                                Activity Log
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=logout">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Middle Column - Profile Overview -->
        <div class="col-lg-3 mb-4">
            <!-- Profile Photo Card -->
            <div class="profile-card profile-section">
                <div class="profile-card-header">
                    <h2><i class="bi bi-person-badge me-2"></i>Profile</h2>
                </div>
                <div class="profile-card-body">
                    <div class="profile-photo-section">
                        <div class="profile-photo">
                            <img src="<?php echo htmlspecialchars($profile_photo); ?>" alt="Profile Photo" id="profilePhotoPreview">
                            <a href="index.php?page=upload_photo" class="edit-photo" title="Change Profile Photo">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                        </div>
                        <div class="profile-name"><?php echo htmlspecialchars($username); ?></div>
                        <div class="profile-role"><?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? 'user')); ?></div>
                    </div>

                    <div class="profile-info">
                        <div class="info-item">
                            <div class="info-label"><i class="bi bi-calendar3 me-2"></i>Member Since</div>
                            <div class="info-value"><?php echo htmlspecialchars($created_at); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="bi bi-shield-check me-2"></i>Status</div>
                            <div class="info-value"><span class="badge bg-success">Active</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Profile Details -->
        <div class="col-lg-6">
            <!-- Profile Tabs Card -->
            <div class="profile-card profile-section">
                <div class="profile-card-header">
                    <h2><i class="bi bi-person-lines-fill me-2"></i>Profile Details</h2>
                </div>
                <div class="profile-card-body">
                    <!-- Tab Navigation -->
                    <div class="profile-tabs">
                        <button class="tab-button active" data-tab="personal-info">
                            <i class="bi bi-person me-2"></i>Personal Info
                        </button>
                        <button class="tab-button" data-tab="account-security">
                            <i class="bi bi-shield-lock me-2"></i>Security
                        </button>
                        <button class="tab-button" data-tab="activity-log">
                            <i class="bi bi-clock-history me-2"></i>Activity
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div id="personal-info" class="tab-content active">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">First Name</div>
                                    <div class="info-value"><?php echo htmlspecialchars($firstName); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Last Name</div>
                                    <div class="info-value"><?php echo htmlspecialchars($lastName); ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Email Address</div>
                            <div class="info-value"><?php echo htmlspecialchars($email); ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Phone Number</div>
                            <div class="info-value"><?php echo htmlspecialchars($phone); ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Username</div>
                            <div class="info-value"><?php echo htmlspecialchars($username); ?></div>
                        </div>
                    </div>

                    <div id="account-security" class="tab-content">
                        <div class="info-item">
                            <div class="info-label">Password</div>
                            <div class="info-value">••••••••</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Two-Factor Authentication</div>
                            <div class="info-value"><span class="badge bg-success">Enabled</span></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Last Password Change</div>
                            <div class="info-value">Not available</div>
                        </div>

                        <div class="mt-4">
                            <a href="index.php?page=change_password" class="btn btn-primary">
                                <i class="bi bi-key me-2"></i>Change Password
                            </a>
                        </div>
                    </div>

                    <div id="activity-log" class="tab-content">
                        <?php if (empty($activities)): ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>No recent activities to display.
                            </div>
                        <?php else: ?>
                            <?php foreach ($activities as $activity): ?>
                                <div class="activity-item">
                                    <div class="activity-date">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        <?php echo date('M d, Y H:i', strtotime($activity['created_at'])); ?>
                                    </div>
                                    <div class="activity-title">
                                        <?php echo htmlspecialchars($activity['activity_type']); ?>
                                    </div>
                                    <div class="activity-description">
                                        <?php echo htmlspecialchars($activity['description']); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Update Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateProfileForm" action="index.php?page=update_profile" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profilePhoto" class="form-label">Profile Photo</label>
                        <input type="file" class="form-control" id="profilePhoto" name="profile_photo" accept="image/*">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">
                    <i class="bi bi-key me-2"></i>Change Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm" action="index.php?page=change_password" method="POST">
                    <div class="form-group">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo Modal -->
<div class="modal fade" id="updatePhotoModal" tabindex="-1" aria-labelledby="updatePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePhotoModalLabel">
                    <i class="bi bi-camera me-2"></i>Update Profile Photo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updatePhotoForm" action="index.php?page=update_photo" method="POST" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        <div class="profile-photo-preview">
                            <img src="<?php echo htmlspecialchars($profile_photo); ?>" alt="Profile Photo" id="photoPreview" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #0d6efd;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profilePhotoUpload" class="form-label">Choose New Photo</label>
                        <input type="file" class="form-control" id="profilePhotoUpload" name="profile_photo" accept="image/*">
                        <div class="invalid-feedback"></div>
                        <div class="form-text mt-2">
                            <i class="bi bi-info-circle me-1"></i>Recommended size: 300x300 pixels. Maximum file size: 2MB.
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Update Photo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>