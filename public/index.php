<?php
// Debug line to verify execution
error_log('Index.php is being executed');
session_start();

// Include composer's autoloader
require_once __DIR__ . '/../../vendor/autoload.php';

// Include database configuration
require_once __DIR__ . '/../config/database.php';

// Use the proper namespaces
use App\Controller\UserController;
use App\Controller\LoginController;
use App\Controller\TwoFactorController;
use App\Controller\VerifyController;
use App\View\View;

// Instantiate the controllers and view
$controller = new UserController($pdo);
$view = new View();
$loginController = new LoginController($pdo);
$twoFactorController = new TwoFactorController($pdo);
$verifyController = new VerifyController($pdo);

// Get the requested page
$page = $_GET['page'] ?? 'login';
$page = basename($page); // Prevent path traversal (ensures safety)

switch ($page) {
    case 'login':
        // Check if user is already logged in
        if (isset($_SESSION['user_id'])) {
            // Redirect based on user role
            if ($_SESSION['role'] === 'admin') {
                header("Location: index.php?page=admin_dashboard");
            } else {
                header("Location: index.php?page=userdashboard");
            }
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['email'] ?? ''; // Using email field as username
            $password = $_POST['password'] ?? '';

            $result = $loginController->login($username, $password);

            if ($result['success']) {
                // If 2FA is successful, redirect to verification page
                $_SESSION['success_message'] = $result['message'];
                header("Location: index.php?page=" . $result['redirect']);
                exit;
            } else {
                // If login fails, show error message
                $_SESSION['error_message'] = $result['message'];
                header("Location: index.php?page=login");
                exit;
            }
        } else {
            // Make sure we're using the correct view method
            $view_data = [
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null
            ];
            unset($_SESSION['error_message'], $_SESSION['success_message']);

            // Use the view class to display the login page
            $view->display('login.php', $view_data);
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process registration form
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password'] ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');
            $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
            $last_name = htmlspecialchars(trim($_POST['last_name'] ?? ''));

            // Check if passwords match
            if ($password !== $confirm_password) {
                $_SESSION['error_message'] = "Passwords do not match.";
                header("Location: index.php?page=register");
                exit;
            }

            // Validate password length
            if (strlen($password) < 6) {
                $_SESSION['error_message'] = "Password must be at least 6 characters.";
                header("Location: index.php?page=register");
                exit;
            }

            // Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Invalid email format.";
                header("Location: index.php?page=register");
                exit;
            }

            // Check if username is provided
            if (empty($username)) {
                $_SESSION['error_message'] = "Username is required.";
                header("Location: index.php?page=register");
                exit;
            }

            // Register user
            try {
                $controller->register($username, $email, $password, $first_name, $last_name);
                // If we get here, registration was successful and user was redirected
            } catch (Exception $e) {
                error_log("Registration error: " . $e->getMessage());
                $_SESSION['error_message'] = "Registration failed: " . $e->getMessage();
                header("Location: index.php?page=register");
                exit;
            }
        } else {
            // Display registration form
            $view_data = [
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null
            ];
            unset($_SESSION['error_message'], $_SESSION['success_message']);

            $view->display('register.php', $view_data);
        }
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'profile':
        if (isset($_SESSION['user_id'])) {
            // Reset the View state to prevent duplication
            \App\View\View::reset();

            $userId = $_SESSION['user_id'];
            $user = $controller->getUserById($userId);

            if ($user) {
                // Get user activities if available
                $activities = [];
                try {
                    $stmt = $pdo->prepare("
                        SELECT * FROM user_activity
                        WHERE user_id = ?
                        ORDER BY created_at DESC
                        LIMIT 10
                    ");
                    $stmt->execute([$userId]);
                    $activities = $stmt->fetchAll();
                } catch (PDOException $e) {
                    // Just log the error but continue - activities are not critical
                    error_log("Error fetching activities: " . $e->getMessage());
                }

                // Format created_at date
                $created_at = isset($user['created_at']) ? date("F Y", strtotime($user['created_at'])) : 'Not available';

                // Set default profile photo if not available
                $profile_photo = (!empty($user['profile_photo'])) ? $user['profile_photo'] : 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y';

                // Get last online time
                $last_online = date("M d, Y H:i");
                if (isset($user['last_login']) && !empty($user['last_login'])) {
                    $last_online = date("M d, Y H:i", strtotime($user['last_login']));
                }

                // Update last login time
                try {
                    $stmt = $pdo->prepare("UPDATE user SET last_login = NOW() WHERE user_id = ?");
                    $stmt->execute([$userId]);
                } catch (PDOException $e) {
                    error_log("Error updating last login time: " . $e->getMessage());
                }

                $view_data = [
                    'user' => $user,
                    'activities' => $activities,
                    'profile_photo' => $profile_photo,
                    'username' => $user['username'] ?? 'User',
                    'firstName' => $user['first_name'] ?? '',
                    'lastName' => $user['last_name'] ?? '',
                    'phone' => $user['phone'] ?? 'Not set',
                    'email' => $user['email'] ?? 'Not set',
                    'created_at' => $created_at,
                    'last_online' => $last_online,
                    'error_message' => $_SESSION['error_message'] ?? null,
                    'success_message' => $_SESSION['success_message'] ?? null,
                    'pageTitle' => 'My Profile',
                    'additionalCss' => [
                        '/userv2/gestion_user/assets/css/login.css',
                        '/userv2/gestion_user/assets/css/profile.css'
                    ],
                    'additionalJs' => ['/userv2/gestion_user/assets/js/profile.js']
                ];

                unset($_SESSION['error_message'], $_SESSION['success_message']);

                // Set the layout to user layout
                $view->setLayout('user');

                // Start output buffering to capture the content
                ob_start();

                // Include the profile template
                include __DIR__ . '/../view/front-office/profile.php';

                // Get the buffered content
                $content = ob_get_clean();

                // Add content to view data
                $view_data['content'] = $content;

                // Display using the user layout
                $view->display('user_layout.php', $view_data);
            } else {
                $_SESSION['error_message'] = "User not found.";
                header('Location: index.php?page=login');
                exit;
            }
        } else {
            $_SESSION['error_message'] = "You must be logged in to view your profile.";
            header('Location: index.php?page=login');
            exit;
        }
        break;

    case 'admin_dashboard':
    case 'admindashboard':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->showAdminDashboard();
        } else {
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'create_user':
    case 'add_user':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->addUser();
        } else {
            $_SESSION['error_message'] = "You must be an admin to access this page.";
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'edit_user':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->editUser();
        } else {
            $_SESSION['error_message'] = "You must be an admin to access this page.";
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'delete_user':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->deleteUserAction($id);
            } else {
                $_SESSION['error_message'] = "User ID is missing.";
                header("Location: index.php?page=admin_dashboard");
                exit;
            }
        } else {
            $_SESSION['error_message'] = "You must be an admin to access this page.";
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'manage_roles':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->manageRoles();
        } else {
            $_SESSION['error_message'] = "You must be an admin to access this page.";
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'export_users':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->exportUsers();
        } else {
            $_SESSION['error_message'] = "You must be an admin to access this page.";
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'users':
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
            $controller->getAllUsers();
        } else {
            $_SESSION['error_message'] = "You must be an admin to access this page.";
            header("Location: index.php?page=login");
            exit;
        }
        break;

    case 'userdashboard':
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "You must be logged in to view the dashboard.";
            header("Location: index.php?page=login");
            exit;
        }

        // Log for debugging
        error_log("Accessing userdashboard route. User ID: " . $_SESSION['user_id'] . ", Role: " . $_SESSION['role']);

        // Reset the View state to prevent duplication
        \App\View\View::reset();

        // Allow both regular users and admins to access the user dashboard
        // This is useful for admins who want to see the user view
        $controller->userDashboard();
        break;

    case 'verify_2fa':
        // Check if user is already fully logged in (not just temp_user_id)
        if (isset($_SESSION['user_id']) && !isset($_SESSION['temp_user_id'])) {
            // Redirect based on user role
            if ($_SESSION['role'] === 'admin') {
                header("Location: index.php?page=admin_dashboard");
            } else {
                header("Location: index.php?page=userdashboard");
            }
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['verification_code'] ?? '';
            $verifyController->verifyCode($code);
        } else {
            // Check if there's a pending 2FA verification
            if (!isset($_SESSION['temp_user_id']) || !isset($_SESSION['2fa_code'])) {
                $_SESSION['error_message'] = "No verification in progress. Please log in again.";
                header("Location: index.php?page=login");
                exit;
            }

            // Display the 2FA verification page
            $view_data = [
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null
            ];
            unset($_SESSION['error_message'], $_SESSION['success_message']);

            $view->display('verify_2fa.php', $view_data);
        }
        break;

    case 'resend_code':
        // Resend verification code
        if (isset($_SESSION['temp_user_id'])) {
            $stmt = $pdo->prepare("SELECT email FROM user WHERE user_id = ?");
            $stmt->execute([$_SESSION['temp_user_id']]);
            $user = $stmt->fetch();

            if ($user) {
                $code = $twoFactorController->generateVerificationCode();
                $_SESSION['2fa_code'] = $code;
                $_SESSION['2fa_expires'] = time() + (10 * 60); // 10 minutes

                if ($twoFactorController->sendVerificationCode($user['email'], $code)) {
                    $_SESSION['success_message'] = "A new verification code has been sent to your email.";
                } else {
                    $_SESSION['error_message'] = "Failed to send verification code. Please try again.";
                }
            }
        }
        header("Location: index.php?page=verify_2fa");
        exit;
        break;

    case 'forgot_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $controller->requestPasswordReset($email);
            header("Location: index.php?page=forgot_password");
            exit;
        } else {
            // Display the forgot password page
            $view_data = [
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null
            ];
            unset($_SESSION['error_message'], $_SESSION['success_message']);

            $view->display('forgot_password.php', $view_data);
        }
        break;

    case 'reset_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if ($password !== $confirm_password) {
                $_SESSION['error_message'] = "Passwords do not match.";
                header("Location: index.php?page=reset_password&token=" . urlencode($token));
                exit;
            }

            $controller->resetPassword($token, $password);
            header("Location: index.php?page=login");
            exit;
        } else {
            if (!isset($_GET['token'])) {
                $_SESSION['error_message'] = "Invalid password reset link.";
                header("Location: index.php?page=login");
                exit;
            }

            // Display the reset password page
            $view_data = [
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null,
                'token' => $_GET['token'] ?? ''
            ];
            unset($_SESSION['error_message'], $_SESSION['success_message']);

            $view->display('reset_password.php', $view_data);
        }
        break;

    case 'edit_info':
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "You must be logged in to edit your information.";
            header("Location: index.php?page=login");
            exit;
        }

        $controller->editInfo();
        break;

    case 'profile_view':
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "You must be logged in to view your profile.";
            header("Location: index.php?page=login");
            exit;
        }

        // Get user data
        $userId = $_SESSION['user_id'];

        try {
            // Get user data directly from database for reliability
            $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Log for debugging
            error_log("Profile View Route: Direct DB fetch result = " . ($user ? 'success' : 'failed'));

            // If direct DB fetch fails, try controller method as fallback
            if (!$user) {
                $user = $controller->getUserById($userId);
                error_log("Profile View Route: Controller fetch result = " . ($user ? 'success' : 'failed'));
            }

            // If still no user data, create from session as last resort
            if (!$user) {
                error_log("Profile View Route: Creating user data from session");
                $user = [
                    'user_id' => $_SESSION['user_id'],
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

            // Get last login time
            $lastLogin = isset($_SESSION['last_login']) ? date('M d, Y h:i A', strtotime($_SESSION['last_login'])) : 'Not available';

            // Create view and display the profile page
            $view = new \App\View\View();

            // Prepare data for the view
            $view_data = [
                'user' => $user,
                'lastLogin' => $lastLogin,
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null,
                'pageTitle' => 'Profile View',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/login.css',
                    '/userv2/gestion_user/assets/css/profile.css'
                ],
                'additionalJs' => ['/userv2/gestion_user/assets/js/profile.js']
            ];

            unset($_SESSION['error_message'], $_SESSION['success_message']);

            // Set the layout to user layout
            $view->setLayout('user');

            // Start output buffering to capture the content
            ob_start();

            // Include the profile view template
            include __DIR__ . '/../view/front-office/profile_view.php';

            // Get the buffered content
            $content = ob_get_clean();

            // Add content to view data
            $view_data['content'] = $content;

            // Display using the user layout
            $view->display('user_layout.php', $view_data);

        } catch (Exception $e) {
            error_log("Profile View Error: " . $e->getMessage());
            $_SESSION['error_message'] = "Error loading profile. Please try again.";
            header("Location: index.php?page=userdashboard");
            exit;
        }
        break;

    case 'upload_photo':
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "You must be logged in to upload a profile photo.";
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['profile_photo'];

                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($file['type'], $allowedTypes)) {
                    $_SESSION['error_message'] = "Invalid file type. Please upload a JPG, PNG, or GIF image.";
                    header("Location: index.php?page=upload_photo");
                    exit;
                }

                // Validate file size (5MB max)
                if ($file['size'] > 5 * 1024 * 1024) {
                    $_SESSION['error_message'] = "File too large. Maximum size is 5MB.";
                    header("Location: index.php?page=upload_photo");
                    exit;
                }

                // Create upload directory if it doesn't exist
                $uploadDir = __DIR__ . '/../assets/img/profile_photos/';

                // Debug upload directory
                error_log("Upload directory: " . $uploadDir);

                if (!file_exists($uploadDir)) {
                    error_log("Creating upload directory: " . $uploadDir);
                    $result = mkdir($uploadDir, 0777, true);
                    error_log("Directory creation result: " . ($result ? 'success' : 'failed'));

                    // If directory creation failed, try an alternative location
                    if (!$result) {
                        $uploadDir = __DIR__ . '/../../uploads/profile_photos/';
                        error_log("Trying alternative upload directory: " . $uploadDir);

                        if (!file_exists($uploadDir)) {
                            error_log("Creating alternative upload directory");
                            mkdir($uploadDir, 0777, true);
                        }
                    }
                }

                $fileName = 'profile_' . $_SESSION['user_id'] . '_' . time() . '_' . basename($file['name']);
                $targetPath = $uploadDir . $fileName;

                // Debug file upload
                error_log("Attempting to move uploaded file to: " . $targetPath);

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    error_log("File upload successful");

                    // Generate the correct URL based on the upload directory
                    if (strpos($uploadDir, '/assets/img/') !== false) {
                        $photoUrl = '/userv2/gestion_user/assets/img/profile_photos/' . $fileName;
                    } else {
                        $photoUrl = '/userv2/uploads/profile_photos/' . $fileName;
                    }

                    error_log("Photo URL: " . $photoUrl);

                    // Update the profile photo in the database
                    try {
                        $stmt = $pdo->prepare("UPDATE user SET profile_photo = ? WHERE user_id = ?");
                        if ($stmt->execute([$photoUrl, $_SESSION['user_id']])) {
                            $_SESSION['profile_photo'] = $photoUrl;
                            $_SESSION['success_message'] = "Profile photo updated successfully.";
                            header("Location: index.php?page=userdashboard");
                            exit;
                        } else {
                            $_SESSION['error_message'] = "Failed to update profile photo in database.";
                        }
                    } catch (PDOException $e) {
                        error_log("Error updating profile photo: " . $e->getMessage());
                        $_SESSION['error_message'] = "Database error. Please try again.";
                    }
                } else {
                    error_log("File upload failed: " . (error_get_last()['message'] ?? 'Unknown error'));
                    $_SESSION['error_message'] = "Failed to upload file. Please try again.";

                    // Check file permissions
                    if (file_exists($uploadDir)) {
                        error_log("Upload directory permissions: " . substr(sprintf('%o', fileperms($uploadDir)), -4));
                    } else {
                        error_log("Upload directory does not exist after creation attempt");
                    }
                }
            } else {
                $_SESSION['error_message'] = "No file uploaded or upload error occurred.";
            }

            header("Location: index.php?page=upload_photo");
            exit;
        } else {
            // Get user data
            $userId = $_SESSION['user_id'];
            $user = $controller->getUserById($userId);

            if (!$user) {
                $_SESSION['error_message'] = "User not found.";
                header("Location: index.php?page=login");
                exit;
            }

            // Set the layout to user layout
            $view->setLayout('user');

            // Display the upload photo page
            $view_data = [
                'user' => $user,
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null,
                'pageTitle' => 'Upload Profile Photo',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/login.css',
                    '/userv2/gestion_user/assets/css/profile.css'
                ]
            ];

            // Start output buffering to capture the content
            ob_start();

            // Include the upload photo template
            include __DIR__ . '/../view/front-office/upload_photo.php';

            // Get the buffered content
            $content = ob_get_clean();

            // Add content to view data
            $view_data['content'] = $content;

            // Display using the user layout
            $view->display('user_layout.php', $view_data);

            unset($_SESSION['error_message'], $_SESSION['success_message']);
        }
        break;

    case 'generate_captcha':
        // Include the image CAPTCHA functions
        require_once __DIR__ . '/../includes/image_captcha.php';

        // Generate and output the CAPTCHA image
        generateCaptchaImage();
        break;

    default:
        // If no specific page is requested but user is logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            // Redirect based on user role
            if ($_SESSION['role'] === 'admin') {
                header("Location: index.php?page=admin_dashboard");
            } else {
                header("Location: index.php?page=userdashboard");
            }
            exit;
        } else if ($page === '') {
            // If no page specified and not logged in, redirect to login
            header("Location: index.php?page=login");
            exit;
        } else {
            // If specific page requested but not found, show 404
            http_response_code(404);
            include __DIR__ . '/../view/404.php';
        }
        break;
}

