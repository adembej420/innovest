<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo $pageTitle ?? 'User Dashboard'; ?> - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/userv2/gestion_user/assets/css/dashboard.css" rel="stylesheet" />
    <link href="/userv2/gestion_user/assets/css/user-sidebar.css" rel="stylesheet" />
    <link href="/userv2/gestion_user/assets/css/header.css" rel="stylesheet" />
    <?php if (isset($additionalCss) && is_array($additionalCss)): ?>
        <?php foreach ($additionalCss as $css): ?>
            <link href="<?php echo $css; ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="index.php?page=userdashboard" class="logo d-flex align-items-center">
                <span>Innovest</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li>
                        <a class="nav-link <?php echo $pageTitle === 'User Dashboard' ? 'active' : ''; ?>" href="index.php?page=userdashboard">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo $pageTitle === 'My Profile' || $pageTitle === 'Profile View' ? 'active' : ''; ?>" href="index.php?page=profile_view">
                            Profile
                        </a>
                    </li>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li>
                        <a class="nav-link" href="index.php?page=admin_dashboard">
                            Admin
                        </a>
                    </li>
                    <?php endif; ?>


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="user-profile text-center">
                    <?php
                    // Define variables for user profile
                    $profilePhoto = $user['profile_photo'] ?? $_SESSION['profile_photo'] ?? '/userv2/gestion_user/assets/img/default-avatar.svg';
                    $username = $user['username'] ?? $_SESSION['username'] ?? 'User';
                    $email = $user['email'] ?? $_SESSION['email'] ?? 'user@example.com';
                    $role = $user['role'] ?? $_SESSION['role'] ?? 'user';
                    ?>
                    <div class="profile-img-container">
                        <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile" class="profile-img">
                    </div>
                    <h5 class="mt-3"><?php echo htmlspecialchars($username); ?></h5>
                    <p class="text-muted"><?php echo htmlspecialchars($email); ?></p>
                    <span class="badge bg-<?php echo $role === 'admin' ? 'danger' : 'primary'; ?>"><?php echo ucfirst(htmlspecialchars($role)); ?></span>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li class="<?php echo $pageTitle === 'User Dashboard' ? 'active' : ''; ?>">
                    <a href="index.php?page=userdashboard">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="<?php echo $pageTitle === 'My Profile' || $pageTitle === 'Profile View' ? 'active' : ''; ?>">
                    <a href="index.php?page=profile_view">
                        <i class="bi bi-person-circle"></i> My Profile
                    </a>
                </li>
                <li class="<?php echo $pageTitle === 'Edit Information' ? 'active' : ''; ?>">
                    <a href="index.php?page=edit_info">
                        <i class="bi bi-pencil-square"></i> Edit Information
                    </a>
                </li>
                <li class="<?php echo $pageTitle === 'Change Password' ? 'active' : ''; ?>">
                    <a href="index.php?page=change_password">
                        <i class="bi bi-shield-lock"></i> Change Password
                    </a>
                </li>
                <li class="<?php echo $pageTitle === 'Upload Profile Photo' ? 'active' : ''; ?>">
                    <a href="index.php?page=upload_photo">
                        <i class="bi bi-camera"></i> Change Photo
                    </a>
                </li>
                <li>
                    <a href="index.php?page=logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="online-status">
                    <span class="status-indicator online"></span>
                    <span>Online</span>
                </div>
                <div class="last-login">
                    <small>Last login: <?php echo isset($lastLogin) ? $lastLogin : date("M d, Y"); ?></small>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Sidebar Toggle Button -->
            <button type="button" id="sidebarCollapse" class="btn btn-primary sidebar-toggle-btn">
                <i class="bi bi-list"></i>
            </button>

            <!-- Main Content -->
            <div class="container-fluid">
                <?php if (isset($error_message) && !empty($error_message)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($success_message) && !empty($success_message)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> <?php echo $success_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php echo $content; ?>
            </div>

            <!-- Footer -->
            <footer class="footer mt-auto py-3 bg-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="text-muted">© 2023 User Management System</span>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="#" class="text-muted">Privacy Policy</a> |
                            <a href="#" class="text-muted">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add overlay div for mobile
            $('body').append('<div class="overlay"></div>');

            // Toggle sidebar only on mobile
            $('#sidebarCollapse').on('click', function () {
                if ($(window).width() < 992) {
                    $('#sidebar').toggleClass('active');
                    $('body').toggleClass('sidebar-active');
                }
            });

            // Close sidebar when clicking on overlay
            $('.overlay').on('click', function () {
                $('#sidebar').addClass('active');
                $('body').removeClass('sidebar-active');
            });

            // Close sidebar when clicking on a link (mobile)
            $('#sidebar a').on('click', function () {
                if ($(window).width() < 992) {
                    $('#sidebar').addClass('active');
                    $('body').removeClass('sidebar-active');
                }
            });

            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() >= 992) {
                    $('#sidebar').removeClass('active'); // Remove active class to show sidebar
                    $('body').removeClass('sidebar-active');
                } else {
                    $('#sidebar').addClass('active'); // Add active class to hide sidebar on mobile
                }
            });

            // Initialize sidebar state based on screen size
            if ($(window).width() >= 992) {
                $('#sidebar').removeClass('active'); // Show sidebar on desktop
            } else {
                $('#sidebar').addClass('active'); // Hide sidebar on mobile
            }

            // Mobile nav toggle
            $('.mobile-nav-toggle').on('click', function() {
                $('body').toggleClass('navbar-mobile');
                $(this).toggleClass('bi-list');
                $(this).toggleClass('bi-x');
            });

            // Mobile nav dropdowns
            $('.navbar .dropdown > a').on('click', function(e) {
                if ($(window).width() < 992) {
                    e.preventDefault();
                    $(this).next().toggleClass('dropdown-active');
                }
            });
        });
    </script>
    <?php if (isset($additionalJs) && is_array($additionalJs)): ?>
        <?php foreach ($additionalJs as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
