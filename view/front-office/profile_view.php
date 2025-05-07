<?php
// Start output buffering
ob_start();

// Debug information
error_log("Profile View Debug: Session user_id = " . ($_SESSION['user_id'] ?? 'not set'));
error_log("Profile View Debug: User variable = " . (isset($user) ? 'set' : 'not set'));

// Make sure we have user data
if (!isset($user) || empty($user)) {
    error_log("Profile View Debug: User data not available, trying to fetch from database");

    // If $user is not set in the view data, try to get it from session
    if (isset($_SESSION['user_id'])) {
        // This is a fallback in case user data wasn't passed correctly
        $userId = $_SESSION['user_id'];

        try {
            // Connect to database
            require_once __DIR__ . '/../../config/db.php';

            // Fetch user data
            $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Profile View Debug: Database fetch result = " . ($user ? 'success' : 'failed'));

            // Set default values if still no user data
            if (!$user) {
                error_log("Profile View Debug: Creating default user data from session");
                $user = [
                    'username' => $_SESSION['username'] ?? 'User',
                    'email' => $_SESSION['email'] ?? 'email@example.com',
                    'first_name' => $_SESSION['first_name'] ?? '',
                    'last_name' => $_SESSION['last_name'] ?? '',
                    'role' => $_SESSION['role'] ?? 'user',
                    'status' => 'active',
                    'created_at' => date('Y-m-d H:i:s'),
                    'profile_photo' => $_SESSION['profile_photo'] ?? '/userv2/gestion_user/assets/img/default-avatar.svg',
                    'phone' => $_SESSION['phone'] ?? ''
                ];
            }
        } catch (Exception $e) {
            error_log("Profile View Debug: Exception: " . $e->getMessage());
            // Create default user data from session if database connection fails
            $user = [
                'username' => $_SESSION['username'] ?? 'User',
                'email' => $_SESSION['email'] ?? 'email@example.com',
                'first_name' => $_SESSION['first_name'] ?? '',
                'last_name' => $_SESSION['last_name'] ?? '',
                'role' => $_SESSION['role'] ?? 'user',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'profile_photo' => $_SESSION['profile_photo'] ?? '/userv2/gestion_user/assets/img/default-avatar.svg',
                'phone' => $_SESSION['phone'] ?? ''
            ];
        }
    } else {
        error_log("Profile View Debug: No user_id in session");
    }
}

// Debug user data
if (isset($user)) {
    error_log("Profile View Debug: User data available - Username: " . ($user['username'] ?? 'not set'));
    error_log("Profile View Debug: User data available - Email: " . ($user['email'] ?? 'not set'));
}

// Ensure we have a lastLogin value
if (!isset($lastLogin) || empty($lastLogin)) {
    $lastLogin = isset($_SESSION['last_login']) ? date('M d, Y h:i A', strtotime($_SESSION['last_login'])) : 'Not available';
}
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <div class="profile-img-container mb-3">
                        <?php
                        // Get profile photo with fallbacks
                        $profilePhoto = isset($user['profile_photo']) && !empty($user['profile_photo'])
                            ? $user['profile_photo']
                            : (isset($_SESSION['profile_photo']) && !empty($_SESSION['profile_photo'])
                                ? $_SESSION['profile_photo']
                                : '/userv2/gestion_user/assets/img/default-avatar.svg');

                        // Debug profile photo
                        error_log("Profile View Debug: Profile photo path = " . $profilePhoto);
                        ?>
                        <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile" class="rounded-circle img-fluid">
                    </div>

                    <?php if (isset($user) && !empty($user)): ?>
                    <h2 class="text-center mb-0">
                        <?php
                        $fullName = trim($user['first_name'] . ' ' . $user['last_name']);
                        echo !empty($fullName) ? htmlspecialchars($fullName) : htmlspecialchars($user['username'] ?? 'User');
                        ?>
                    </h2>
                    <p class="text-muted text-center"><?php echo htmlspecialchars($user['username'] ?? 'Username'); ?></p>
                    <?php else: ?>
                    <h2 class="text-center mb-0">User Profile</h2>
                    <p class="text-muted text-center">Welcome</p>
                    <?php endif; ?>

                    <div class="social-links mt-2 mb-3">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                    <div class="d-grid gap-2 w-100 mt-2">
                        <a href="index.php?page=upload_photo" class="btn btn-primary">
                            <i class="bi bi-camera-fill me-1"></i> Change Photo
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Tabs navigation -->
                    <ul class="nav nav-tabs nav-tabs-bordered mb-3">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content pt-2">
                        <!-- Profile Overview -->
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profile Details</h5>

                            <?php if (isset($user) && !empty($user)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Full Name</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php
                                    $fullName = trim($user['first_name'] . ' ' . $user['last_name']);
                                    echo !empty($fullName) ? htmlspecialchars($fullName) : 'Not provided';
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Username</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo htmlspecialchars($user['username'] ?? 'Not provided'); ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Email</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo htmlspecialchars($user['email'] ?? 'Not provided'); ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Phone</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : 'Not provided'; ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Role</div>
                                <div class="col-lg-9 col-md-8">
                                    <span class="badge bg-<?php echo ($user['role'] ?? '') === 'admin' ? 'danger' : 'primary'; ?>">
                                        <?php echo ucfirst(htmlspecialchars($user['role'] ?? 'user')); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Status</div>
                                <div class="col-lg-9 col-md-8">
                                    <span class="badge bg-<?php echo ($user['status'] ?? '') === 'active' ? 'success' : 'warning'; ?>">
                                        <?php echo ucfirst(htmlspecialchars($user['status'] ?? 'active')); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Member Since</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php
                                    echo isset($user['created_at']) && !empty($user['created_at'])
                                        ? date('F j, Y', strtotime($user['created_at']))
                                        : date('F j, Y');
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 fw-bold">Last Login</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo isset($lastLogin) ? $lastLogin : 'Not available'; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Unable to load user information. Please try refreshing the page.
                            </div>
                            <?php endif; ?>

                            <div class="d-flex justify-content-center mt-4">
                                <a href="index.php?page=edit_info" class="btn btn-primary me-2">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Information
                                </a>
                                <a href="index.php?page=change_password" class="btn btn-secondary">
                                    <i class="bi bi-shield-lock me-1"></i> Change Password
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-img-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border: 5px solid #f8f9fa;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.profile-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: #f8f9fa;
    color: #012970;
    border-radius: 50%;
    margin: 0 5px;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: #0d6efd;
    color: #fff;
}

.card-title {
    font-weight: 600;
    color: #012970;
    border-bottom: 1px solid #ebeef4;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.nav-tabs-bordered .nav-link {
    color: #6c757d;
    border: none;
    border-bottom: 2px solid transparent;
    margin-right: 10px;
}

.nav-tabs-bordered .nav-link:hover {
    color: #012970;
}

.nav-tabs-bordered .nav-link.active {
    color: #012970;
    border-bottom: 2px solid #012970;
    font-weight: 600;
}
</style>

<?php
// Store the content in a variable
$content = ob_get_clean();

// Include the layout file which will use the $content variable
include __DIR__ . '/user_layout.php';
?>
