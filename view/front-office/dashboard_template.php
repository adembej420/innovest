<?php
// Get user information from session if not provided
$username = $user['username'] ?? $_SESSION['username'] ?? 'User';
$email = $user['email'] ?? $_SESSION['email'] ?? 'user@example.com';
$role = $user['role'] ?? $_SESSION['role'] ?? 'user';
$userId = $user['user_id'] ?? $_SESSION['user_id'] ?? '0';

// Set default values for variables that might not be set
$activities = $activities ?? [];
$lastLogin = $lastLogin ?? date("F j, Y, g:i a");
?>

<!-- ======= Hero Section ======= -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-2">Welcome, <?php echo htmlspecialchars($username); ?>!</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex flex-column justify-content-center">
                                <h2 class="mb-4">Your Dashboard</h2>
                                <p class="lead mb-4">Manage your account and access all features from here.</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                                    <a href="index.php?page=profile" class="btn btn-primary btn-lg px-4 me-md-2">
                                        <i class="bi bi-person-circle me-2"></i>View Profile
                                    </a>
                                    <a href="index.php?page=change_password" class="btn btn-outline-secondary btn-lg px-4">
                                        <i class="bi bi-shield-lock me-2"></i>Change Password
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="/userv2/gestion_user/assets/img/dashboard-welcome.svg" class="img-fluid" alt="Welcome" style="max-height: 250px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Stats -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-card text-center">
                            <div class="stats-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <h3>Account</h3>
                            <p>Status: <span class="badge bg-success">Active</span></p>
                            <p>Role: <?php echo ucfirst(htmlspecialchars($role)); ?></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stats-card text-center">
                            <div class="stats-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h3>Security</h3>
                            <p>2FA: <span class="badge bg-success">Enabled</span></p>
                            <p>Last Login: <?php echo $lastLogin; ?></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stats-card text-center">
                            <div class="stats-icon">
                                <i class="bi bi-envelope-check"></i>
                            </div>
                            <h3>Contact</h3>
                            <p>Email: <?php echo htmlspecialchars($email); ?></p>
                            <p>ID: #<?php echo htmlspecialchars($userId); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mb-4">
                    <div class="card-header bg-light">
                        <h4 class="text-primary my-2">Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-person-lines-fill text-primary" style="font-size: 2.5rem;"></i>
                                        </div>
                                        <h5 class="card-title">Update Profile</h5>
                                        <p class="card-text">Manage your personal information and preferences</p>
                                        <a href="index.php?page=profile" class="btn btn-sm btn-outline-primary">Go to Profile</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-key text-primary" style="font-size: 2.5rem;"></i>
                                        </div>
                                        <h5 class="card-title">Change Password</h5>
                                        <p class="card-text">Keep your account secure with regular password updates</p>
                                        <a href="index.php?page=change_password" class="btn btn-sm btn-outline-primary">Change Password</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-clock-history text-primary" style="font-size: 2.5rem;"></i>
                                        </div>
                                        <h5 class="card-title">Activity Log</h5>
                                        <p class="card-text">Track your account activity and login history</p>
                                        <a href="index.php?page=activity" class="btn btn-sm btn-outline-primary">View Activity</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mb-4">
                    <div class="card-header bg-light">
                        <h4 class="text-primary my-2">Recent Activity</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($activities)): ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>No recent activities to display.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($activities as $activity): ?>
                                            <tr>
                                                <td><?php echo date('M d, Y H:i', strtotime($activity['created_at'])); ?></td>
                                                <td><?php echo htmlspecialchars($activity['activity_type']); ?></td>
                                                <td><?php echo htmlspecialchars($activity['description']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                        <div class="mt-3">
                            <p class="text-muted"><i class="bi bi-clock me-2"></i>Last login: <?php echo $lastLogin; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>