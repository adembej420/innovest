<?php
namespace App\Controller;

use PDO;
use PDOException;

class UserController {
    private $pdo;
    private $template_dir;

    public function __construct($pdo, $template_dir = null) {
        $this->pdo = $pdo;
        $this->template_dir = $template_dir ?? __DIR__ . '/front-office/';
    }

    public function login($email, $password) {
        $email = trim($email);
        $password = trim($password);

        if (empty($email) || empty($password)) {
            $_SESSION['error_message'] = "Please enter email and password!";
            header('Location: index.php?page=login');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Invalid email format!";
            header('Location: index.php?page=login');
            exit;
        }

        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ? AND status = 'active'");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error_message'] = "Invalid email or password!";
            header('Location: index.php?page=login');
            exit;
        }

        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Update user status to 'active'
        $stmt = $this->pdo->prepare("UPDATE user SET status = 'active' WHERE user_id = ?");
        $stmt->execute([$user['user_id']]);

        // Redirect based on user role
        if ($user['role'] === 'admin') {
            header('Location: index.php?page=admin_dashboard');
        } else {
            header('Location: index.php?page=userdashboard');
        }
        exit;
    }

    public function sendVerificationCode($email, $code) {
        $subject = 'Your Verification Code';
        $message = "Your verification code is: $code";
        $headers = 'From: noreply@yourdomain.com' . "\r\n" .
                   'Reply-To: noreply@yourdomain.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        mail($email, $subject, $message, $headers);
    }



    public function register($username, $email, $password, $first_name = '', $last_name = '', $role = 'user') {
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error_message'] = "All fields are required!";
            header("Location: index.php?page=register");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Invalid email format!";
            header("Location: index.php?page=register");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error_message'] = "Password must be at least 6 characters!";
            header("Location: index.php?page=register");
            exit;
        }

        $stmt = $this->pdo->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error_message'] = "Email already registered!";
            header("Location: index.php?page=register");
            exit;
        }

        if ($role === 'admin' && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
            $role = 'user';
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO user (username, email, password, first_name, last_name, role)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$username, $email, $hashedPassword, $first_name, $last_name, $role]);

            // Fetch the newly created user
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Update user status to 'active'
                $stmt = $this->pdo->prepare("UPDATE user SET status = 'active' WHERE user_id = ?");
                $stmt->execute([$user['user_id']]);

                // Redirect based on user role
                if ($user['role'] === 'admin') {
                    header('Location: index.php?page=admin_dashboard');
                } else {
                    header('Location: index.php?page=userdashboard');
                }
                exit;
            } else {
                $_SESSION['error_message'] = "Registration failed. Please try again.";
                header("Location: index.php?page=register");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            $_SESSION['error_message'] = "Registration failed. Please try again.";
            header("Location: index.php?page=register");
            exit;
        }
    }

    public function userDashboard() {
        try {
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error_message'] = "You must be logged in to view the dashboard.";
                header("Location: index.php?page=login");
                exit;
            }

            // Log for debugging
            error_log("Loading dashboard for user ID: " . $_SESSION['user_id']);

            // Get user data
            $stmt = $this->pdo->prepare("
                SELECT * FROM user
                WHERE user_id = ?
            ");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();

            if (!$user) {
                error_log("User not found: " . $_SESSION['user_id']);
                $_SESSION['error_message'] = "User not found.";
                header("Location: index.php?page=login");
                exit;
            }

            error_log("User found: " . $user['username'] . " (ID: " . $user['user_id'] . ")");

            // Get recent activities (if the table exists)
            $activities = [];
            try {
                $stmt = $this->pdo->prepare("
                    SELECT * FROM user_activity
                    WHERE user_id = ?
                    ORDER BY created_at DESC
                    LIMIT 5
                ");
                $stmt->execute([$_SESSION['user_id']]);
                $activities = $stmt->fetchAll();
            } catch (PDOException $e) {
                // Just log the error but continue - activities are not critical
                error_log("Error fetching activities: " . $e->getMessage());
            }

            // Format last login time
            $lastLogin = date("F j, Y, g:i a");
            if (isset($user['last_login']) && !empty($user['last_login'])) {
                $lastLogin = date("F j, Y, g:i a", strtotime($user['last_login']));
            }

            // Start output buffering to capture the content
            ob_start();

            // Include the dashboard template
            include __DIR__ . '/../view/front-office/dashboard_template.php';

            // Get the buffered content
            $content = ob_get_clean();

            // Create a new View instance
            $view = new \App\View\View();

            // Set the layout to user layout
            $view->setLayout('user');

            // Display the dashboard using the View class and user layout
            $view->display('user_layout.php', [
                'content' => $content,
                'user' => $user,
                'activities' => $activities,
                'lastLogin' => $lastLogin,
                'pageTitle' => 'User Dashboard',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/login.css',
                    '/userv2/gestion_user/assets/css/dashboard.css'
                ],
                'additionalJs' => ['/userv2/gestion_user/assets/js/dashboard.js']
            ]);

        } catch (PDOException $e) {
            error_log("User Dashboard Error: " . $e->getMessage());
            $_SESSION['error_message'] = "Error loading dashboard: " . $e->getMessage();
            header("Location: index.php?page=login");
            exit;
        } catch (Exception $e) {
            error_log("General Dashboard Error: " . $e->getMessage());
            $_SESSION['error_message'] = "Error loading dashboard: " . $e->getMessage();
            header("Location: index.php?page=login");
            exit;
        }
    }

    public function createUser($data) {
        // User creation logic can be implemented here (user-only, no admin logic)
        // This is now a stub to avoid parse errors and admin logic
        return ['error' => 'Not implemented'];
    }

    public function getUsers($filters = []) {
        $where = [];
        $params = [];

        if (!empty($filters['role'])) {
            $where[] = "role = ?";
            $params[] = $filters['role'];
        }

        $sql = "SELECT user_id, username, email, role FROM user";
        if ($where) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        // Fetch user details for the profile page
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!$user) {
            header("Location: index.php?page=login");
            exit;
        }

        // Update session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['created_at'] = $user['created_at'];
        $_SESSION['profile_photo'] = $user['profile_photo']; // Always use 'profile_photo' column
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];

        return $user;
    }

    public function updateProfile() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Not authenticated']);
            exit;
        }

        $id = $_SESSION['user_id'];
        $data = json_decode(file_get_contents('php://input'), true);

        // Fetch user details for the profile page
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if (!$user) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'User not found']);
            exit;
        }

        // Update session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['created_at'] = $user['created_at'];
        $_SESSION['profile_photo'] = $user['profile_photo']; // Always use 'profile_photo' column
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];

        // Handle name update
        if (isset($data['first_name']) || isset($data['last_name'])) {
            // Update first name if provided
            if (isset($data['first_name'])) {
                $stmt = $this->pdo->prepare("UPDATE user SET first_name = ? WHERE user_id = ?");
                $stmt->execute([$data['first_name'], $id]);
                $_SESSION['first_name'] = $data['first_name'];
            }

            // Update last name if provided
            if (isset($data['last_name'])) {
                $stmt = $this->pdo->prepare("UPDATE user SET last_name = ? WHERE user_id = ?");
                $stmt->execute([$data['last_name'], $id]);
                $_SESSION['last_name'] = $data['last_name'];
            }

            // Return success with updated names
            echo json_encode([
                'success' => true,
                'first_name' => $_SESSION['first_name'] ?? '',
                'last_name' => $_SESSION['last_name'] ?? ''
            ]);
            exit;
        }

        // Handle email update
        if (isset($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid email format']);
                exit;
            }

            $stmt = $this->pdo->prepare("UPDATE user SET email = ? WHERE user_id = ?");
            if ($stmt->execute([$data['email'], $id])) {
                $_SESSION['email'] = $data['email'];
                echo json_encode(['success' => true]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Failed to update email']);
            }
            exit;
        }

        // Handle phone update
        if (isset($data['phone'])) {
            $stmt = $this->pdo->prepare("UPDATE user SET phone = ? WHERE user_id = ?");
            if ($stmt->execute([$data['phone'], $id])) {
                $_SESSION['phone'] = $data['phone'];
                echo json_encode(['success' => true]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Failed to update phone']);
            }
            exit;
        }
    }

    public function editInfo() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "You must be logged in to edit your information.";
            header("Location: index.php?page=login");
            exit;
        }

        // Include the CAPTCHA functions
        require_once __DIR__ . '/../includes/captcha.php';

        // Get user data
        $userId = $_SESSION['user_id'];
        $user = $this->getUserById($userId);

        if (!$user) {
            $_SESSION['error_message'] = "User not found.";
            header("Location: index.php?page=login");
            exit;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim(htmlspecialchars($_POST['first_name'] ?? ''));
            $lastName = trim(htmlspecialchars($_POST['last_name'] ?? ''));
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $phone = trim(htmlspecialchars($_POST['phone'] ?? ''));
            $captcha = trim($_POST['captcha'] ?? '');

            // Verify CAPTCHA
            if (!verifyCaptcha($captcha)) {
                $_SESSION['error_message'] = "Invalid security code. Please try again.";
                header("Location: index.php?page=edit_info");
                exit;
            }

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Please enter a valid email address.";
                header("Location: index.php?page=edit_info");
                exit;
            }

            // Check if email is already used by another user
            $stmt = $this->pdo->prepare("SELECT user_id FROM user WHERE email = ? AND user_id != ?");
            $stmt->execute([$email, $userId]);
            if ($stmt->fetch()) {
                $_SESSION['error_message'] = "Email is already registered to another user.";
                header("Location: index.php?page=edit_info");
                exit;
            }

            try {
                // Update user information
                $stmt = $this->pdo->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE user_id = ?");
                $stmt->execute([$firstName, $lastName, $email, $phone, $userId]);

                // Update session variables
                $_SESSION['first_name'] = $firstName;
                $_SESSION['last_name'] = $lastName;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;

                $_SESSION['success_message'] = "Your information has been updated successfully.";
                header("Location: index.php?page=userdashboard");
                exit;
            } catch (PDOException $e) {
                error_log("Error updating user information: " . $e->getMessage());
                $_SESSION['error_message'] = "Database error. Please try again.";
                header("Location: index.php?page=edit_info");
                exit;
            }
        }

        // Display the edit info form
        $firstName = $user['first_name'] ?? '';
        $lastName = $user['last_name'] ?? '';
        $email = $user['email'] ?? '';
        $phone = $user['phone'] ?? '';
        $username = $user['username'] ?? '';

        // Create view and display the edit info page
        $view = new \App\View\View();
        $view->setLayout('user');

        // Start output buffering to capture the content
        ob_start();

        // Include the edit info template
        include __DIR__ . '/../view/front-office/edit_info.php';

        // Get the buffered content
        $content = ob_get_clean();

        // Display using the user layout
        $view->display('user_layout.php', [
            'content' => $content,
            'user' => $user,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'username' => $username,
            'error_message' => $_SESSION['error_message'] ?? null,
            'success_message' => $_SESSION['success_message'] ?? null,
            'pageTitle' => 'Edit Information',
            'additionalCss' => [
                '/userv2/gestion_user/assets/css/login.css',
                '/userv2/gestion_user/assets/css/dashboard.css'
            ]
        ]);

        // Clear session messages
        unset($_SESSION['error_message'], $_SESSION['success_message']);
    }


    public function deleteUserAction($id) {
        // Check if user is admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "Access denied: Admin privileges required";
            header("Location: index.php?page=login");
            exit;
        }

        // Prevent admin from deleting themselves
        if ($id == $_SESSION['user_id']) {
            $_SESSION['error_message'] = "You cannot delete your own account.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        }

        try {
            // Check if user exists
            $stmt = $this->pdo->prepare("SELECT username FROM user WHERE user_id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch();

            if (!$user) {
                $_SESSION['error_message'] = "User not found.";
                header("Location: index.php?page=admin_dashboard");
                exit;
            }

            // Delete user
            $stmt = $this->pdo->prepare("DELETE FROM user WHERE user_id = ?");
            $stmt->execute([$id]);

            $_SESSION['success_message'] = "User '" . $user['username'] . "' has been deleted successfully.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        } catch (PDOException $e) {
            error_log("User deletion failed: " . $e->getMessage());
            $_SESSION['error_message'] = "Database error. Please try again.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        }
    }


    public function getUserById($userId) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error fetching user: " . $e->getMessage());
            return false;
        }
    }
    private function verifyPassword(string $inputPassword, string $hashedPassword): bool {
        return password_verify($inputPassword, $hashedPassword);
    }

    public function logout() {
        // Update user status to 'inactive' when they log out
        if (isset($_SESSION['user_id'])) {
            $stmt = $this->pdo->prepare("UPDATE user SET status = 'inactive' WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
        }

        // Clear session data
        session_unset();
        session_destroy();

        // Redirect to login page
        header('Location: index.php?page=login');
        exit;
    }
    public function addUser() {
        // 1. Verify admin privileges and session
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "Access denied: Admin privileges required";
            header("Location: index.php?page=login");
            exit;
        }

        // 2. Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF protection
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error_message'] = "Invalid CSRF token";
                header("Location: index.php?page=add_user");
                exit;
            }

            // Sanitize inputs
            $username = trim(htmlspecialchars($_POST['username']));
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $role = in_array($_POST['role'], ['user', 'admin']) ? $_POST['role'] : 'user';

            // Validate inputs
            $errors = [];
            if (empty($username) || strlen($username) < 3) {
                $errors[] = "Username must be at least 3 characters";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters";
            }

            if (!empty($errors)) {
                $_SESSION['error_message'] = implode("<br>", $errors);
                header("Location: index.php?page=add_user");
                exit;
            }

            // Check for existing email
            $stmt = $this->pdo->prepare("SELECT user_id FROM user WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $_SESSION['error_message'] = "Email already registered";
                header("Location: index.php?page=add_user");
                exit;
            }

            // Insert into database
            try {
                $stmt = $this->pdo->prepare("
                    INSERT INTO user (username, email, password, role, created_at)
                    VALUES (?, ?, ?, ?, NOW())
                ");
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt->execute([$username, $email, $hashedPassword, $role]);

                $_SESSION['success_message'] = "User added successfully!";
                header("Location: index.php?page=admindashboard");
                exit;
            } catch (PDOException $e) {
                error_log("User creation failed: " . $e->getMessage());
                $_SESSION['error_message'] = "Database error. Please try again.";
                header("Location: index.php?page=add_user");
                exit;
            }
        }

        // 3. Generate CSRF token and render form for GET requests
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Create view and display the add user page
        $view = new \App\View\View();
        $view->display('add_user.php', [
            'error_message' => $_SESSION['error_message'] ?? null,
            'success_message' => $_SESSION['success_message'] ?? null,
            'pageTitle' => 'Add New User',
            'additionalCss' => [
                '/userv2/gestion_user/assets/css/admin.css'
            ]
        ]);

        // Clear session messages
        unset($_SESSION['error_message'], $_SESSION['success_message']);
    }
    public function exportUsers() {
        require_once __DIR__ . '/../config/db.php';
        global $pdo;

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=users.csv');

        $stmt = $pdo->query("SELECT username, email, role FROM user");
        $users = $stmt->fetchAll();

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Username', 'Email', 'Role']); // headers

        foreach ($users as $user) {
            fputcsv($output, [$user['username'], $user['email'], $user['role']]);
        }

        fclose($output);
        exit;
    }
    public function editUser() {
        // Check if user is admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "Access denied: Admin privileges required";
            header("Location: index.php?page=login");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error_message'] = "User ID is missing.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        }

        // Fetch user by ID
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch();

            if (!$user) {
                $_SESSION['error_message'] = "User not found.";
                header("Location: index.php?page=admin_dashboard");
                exit;
            }

            // If form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = trim(htmlspecialchars($_POST['username']));
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $role = in_array($_POST['role'], ['user', 'admin']) ? $_POST['role'] : 'user';
                $status = in_array($_POST['status'], ['active', 'inactive']) ? $_POST['status'] : 'active';

                // Validate inputs
                $errors = [];
                if (empty($username) || strlen($username) < 3) {
                    $errors[] = "Username must be at least 3 characters";
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format";
                }

                if (!empty($errors)) {
                    $_SESSION['error_message'] = implode("<br>", $errors);
                    header("Location: index.php?page=edit_user&id=" . $id);
                    exit;
                }

                // Check if email is already used by another user
                $stmt = $this->pdo->prepare("SELECT user_id FROM user WHERE email = ? AND user_id != ?");
                $stmt->execute([$email, $id]);
                if ($stmt->fetch()) {
                    $_SESSION['error_message'] = "Email already registered to another user.";
                    header("Location: index.php?page=edit_user&id=" . $id);
                    exit;
                }

                // Update user
                $stmt = $this->pdo->prepare("UPDATE user SET username = ?, email = ?, role = ?, status = ? WHERE user_id = ?");
                $stmt->execute([$username, $email, $role, $status, $id]);

                $_SESSION['success_message'] = "User updated successfully.";
                header("Location: index.php?page=admin_dashboard");
                exit;
            }

            // Display edit user form
            $view = new \App\View\View();
            $view->display('edit_user.php', [
                'user' => $user,
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null,
                'pageTitle' => 'Edit User',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/admin.css'
                ]
            ]);

            // Clear session messages
            unset($_SESSION['error_message'], $_SESSION['success_message']);
        } catch (PDOException $e) {
            error_log("Error editing user: " . $e->getMessage());
            $_SESSION['error_message'] = "Database error. Please try again.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        }
    }
   // controller/UserController.php

    public function changePassword() {
        if (!isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $_SESSION['error_message'] = "You must be logged in to change your password.";
                header("Location: index.php?page=login");
                exit;
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Not authenticated']);
                exit;
            }
        }

        // Include the image CAPTCHA functions
        require_once __DIR__ . '/../includes/image_captcha.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $captcha = $_POST['captcha'] ?? '';

            // Verify CAPTCHA
            if (!isset($_POST['ajax']) && !verifyImageCaptcha($captcha)) {
                $_SESSION['error_message'] = "Invalid security code. Please try again.";
                header("Location: index.php?page=change_password");
                exit;
            }

            if (!$currentPassword || !$newPassword || !$confirmPassword) {
                if (isset($_POST['ajax'])) {
                    http_response_code(400);
                    echo json_encode(['error' => 'All password fields are required']);
                    exit;
                } else {
                    $_SESSION['error_message'] = "All password fields are required.";
                    header("Location: index.php?page=change_password");
                    exit;
                }
            }

            if ($newPassword !== $confirmPassword) {
                if (isset($_POST['ajax'])) {
                    http_response_code(400);
                    echo json_encode(['error' => 'New passwords do not match']);
                    exit;
                } else {
                    $_SESSION['error_message'] = "New passwords do not match.";
                    header("Location: index.php?page=change_password");
                    exit;
                }
            }

            if (strlen($newPassword) < 8) {
                if (isset($_POST['ajax'])) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Password must be at least 8 characters long']);
                    exit;
                } else {
                    $_SESSION['error_message'] = "Password must be at least 8 characters long.";
                    header("Location: index.php?page=change_password");
                    exit;
                }
            }

            // Verify current password
            $stmt = $this->pdo->prepare("SELECT password FROM user WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();

            if (!$user || !password_verify($currentPassword, $user['password'])) {
                if (isset($_POST['ajax'])) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Current password is incorrect']);
                    exit;
                } else {
                    $_SESSION['error_message'] = "Current password is incorrect.";
                    header("Location: index.php?page=change_password");
                    exit;
                }
            }

            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE user SET password = ? WHERE user_id = ?");
            if ($stmt->execute([$hashedPassword, $_SESSION['user_id']])) {
                if (isset($_POST['ajax'])) {
                    echo json_encode(['success' => true]);
                    exit;
                } else {
                    $_SESSION['success_message'] = "Password updated successfully.";
                    header("Location: index.php?page=userdashboard");
                    exit;
                }
            } else {
                if (isset($_POST['ajax'])) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to update password']);
                    exit;
                } else {
                    $_SESSION['error_message'] = "Failed to update password.";
                    header("Location: index.php?page=change_password");
                    exit;
                }
            }
        }

        // Get user data
        $userId = $_SESSION['user_id'];
        $user = $this->getUserById($userId);

        if (!$user) {
            $_SESSION['error_message'] = "User not found.";
            header("Location: index.php?page=login");
            exit;
        }

        // Create view and display the change password page
        $view = new \App\View\View();
        $view->setLayout('user');

        // Start output buffering to capture the content
        ob_start();

        // Include the change password template
        include __DIR__ . '/../view/front-office/change_password.php';

        // Get the buffered content
        $content = ob_get_clean();

        // Display using the user layout
        $view->display('user_layout.php', [
            'content' => $content,
            'user' => $user,
            'error_message' => $_SESSION['error_message'] ?? null,
            'success_message' => $_SESSION['success_message'] ?? null,
            'pageTitle' => 'Change Password',
            'additionalCss' => [
                '/userv2/gestion_user/assets/css/login.css',
                '/userv2/gestion_user/assets/css/dashboard.css'
            ]
        ]);

        // Clear session messages
        unset($_SESSION['error_message'], $_SESSION['success_message']);
    }

    public function showAdminDashboard() {
        try {
            // Get total users count
            $totalUsers = $this->pdo->query("SELECT COUNT(*) FROM user")->fetchColumn();

            // Get active users count
            $activeUsers = $this->pdo->query("SELECT COUNT(*) FROM user WHERE status = 'active'")->fetchColumn();

            // Get new users today count
            $newUsers = $this->pdo->query("SELECT COUNT(*) FROM user WHERE DATE(created_at) = CURDATE()")->fetchColumn();

            // Get recent users
            $stmt = $this->pdo->query("SELECT * FROM user ORDER BY created_at DESC LIMIT 5");
            $recentUsers = $stmt->fetchAll();

            // Get all users for the table
            $stmt = $this->pdo->query("SELECT * FROM user ORDER BY created_at DESC");
            $allUsers = $stmt->fetchAll();

            $view = new \App\View\View();
            $view->display('admin_dashboard.php', [
                'users' => $allUsers,
                'recentUsers' => $recentUsers,
                'totalUsers' => $totalUsers,
                'activeUsers' => $activeUsers,
                'newUsers' => $newUsers,
                'pageTitle' => 'Admin Dashboard',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/admin.css',
                    '/userv2/gestion_user/assets/css/admin-dashboard.css'
                ],
                'additionalJs' => [
                    '/userv2/gestion_user/assets/js/admin-dashboard.js'
                ]
            ]);
        } catch (PDOException $e) {
            error_log("Admin Dashboard Error: " . $e->getMessage());
            $_SESSION['error_message'] = "Error loading dashboard";
            header("Location: index.php?page=login");
            exit;
        }
    }

    public function requestPasswordReset($email) {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Invalid email format.";
            return false;
        }

        // Check if user exists
        $stmt = $this->pdo->prepare("SELECT user_id FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $_SESSION['error_message'] = "No account found with this email address.";
            return false;
        }

        // Generate reset token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store token in database
        $stmt = $this->pdo->prepare("INSERT INTO reset_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$user['user_id'], $token, $expires]);

        // Create reset link
        $resetLink = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php?page=reset_password&token=" . $token;

        // Send email
        $subject = 'Password Reset Request';
        $message = "Hello,\n\n";
        $message .= "You have requested to reset your password. Click the link below to reset your password:\n\n";
        $message .= $resetLink . "\n\n";
        $message .= "This link will expire in 1 hour.\n\n";
        $message .= "If you did not request this password reset, please ignore this email.\n\n";
        $message .= "Best regards,\nUser Management System";

        $headers = 'From: noreply@yourdomain.com' . "\r\n" .
                  'Reply-To: noreply@yourdomain.com' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['success_message'] = "Password reset instructions have been sent to your email.";
            return true;
        } else {
            $_SESSION['error_message'] = "Failed to send password reset email. Please try again.";
            return false;
        }
    }

    public function resetPassword($token, $newPassword) {
        // Validate token
        $stmt = $this->pdo->prepare("
            SELECT rt.user_id, rt.expires_at
            FROM reset_tokens rt
            WHERE rt.token = ? AND rt.expires_at > NOW()
        ");
        $stmt->execute([$token]);
        $tokenData = $stmt->fetch();

        if (!$tokenData) {
            $_SESSION['error_message'] = "Invalid or expired reset token.";
            return false;
        }

        // Log for debugging
        error_log("Resetting password for user ID: " . $tokenData['user_id']);

        // Hash new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password and set status to active
        $stmt = $this->pdo->prepare("UPDATE user SET password = ?, status = 'active' WHERE user_id = ?");
        if ($stmt->execute([$hashedPassword, $tokenData['user_id']])) {
            // Delete used token
            $stmt = $this->pdo->prepare("DELETE FROM reset_tokens WHERE token = ?");
            $stmt->execute([$token]);

            // Log success
            error_log("Password reset successful for user ID: " . $tokenData['user_id']);

            $_SESSION['success_message'] = "Your password has been reset successfully. You can now login with your new password.";
            return true;
        }

        // Log failure
        error_log("Password reset failed for user ID: " . $tokenData['user_id']);
        $_SESSION['error_message'] = "Failed to reset password. Please try again.";
        return false;
    }


    public function getAllUsers() {
        // Check if user is admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "Access denied: Admin privileges required";
            header("Location: index.php?page=login");
            exit;
        }

        try {
            // Get filter parameters
            $status = $_GET['status'] ?? null;
            $role = $_GET['role'] ?? null;
            $filter = $_GET['filter'] ?? null;

            // Build query based on filters
            $query = "SELECT * FROM user";
            $params = [];
            $whereConditions = [];

            if ($status) {
                $whereConditions[] = "status = ?";
                $params[] = $status;
            }

            if ($role) {
                $whereConditions[] = "role = ?";
                $params[] = $role;
            }

            if ($filter === 'new') {
                $whereConditions[] = "DATE(created_at) = CURDATE()";
            }

            if (!empty($whereConditions)) {
                $query .= " WHERE " . implode(" AND ", $whereConditions);
            }

            $query .= " ORDER BY created_at DESC";

            // Execute query
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            $users = $stmt->fetchAll();

            // Create view and display the users page
            $view = new \App\View\View();
            $view->display('users.php', [
                'users' => $users,
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null,
                'pageTitle' => 'User Management',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/admin.css'
                ],
                'additionalJs' => [
                    'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js',
                    'https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js'
                ]
            ]);

            // Clear session messages
            unset($_SESSION['error_message'], $_SESSION['success_message']);
        } catch (PDOException $e) {
            error_log("Error fetching users: " . $e->getMessage());
            $_SESSION['error_message'] = "Database error. Please try again.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        }
    }

    public function manageRoles() {
        // Check if user is admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "Access denied: Admin privileges required";
            header("Location: index.php?page=login");
            exit;
        }

        // Handle form submission for role updates
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $newRole = $_POST['role'] ?? null;

            if (!$userId || !$newRole || !in_array($newRole, ['user', 'admin'])) {
                $_SESSION['error_message'] = "Invalid user ID or role.";
                header("Location: index.php?page=manage_roles");
                exit;
            }

            // Prevent admin from changing their own role
            if ($userId == $_SESSION['user_id']) {
                $_SESSION['error_message'] = "You cannot change your own role.";
                header("Location: index.php?page=manage_roles");
                exit;
            }

            try {
                $stmt = $this->pdo->prepare("UPDATE user SET role = ? WHERE user_id = ?");
                $stmt->execute([$newRole, $userId]);

                $_SESSION['success_message'] = "User role updated successfully.";
                header("Location: index.php?page=manage_roles");
                exit;
            } catch (PDOException $e) {
                error_log("Role update failed: " . $e->getMessage());
                $_SESSION['error_message'] = "Database error. Please try again.";
                header("Location: index.php?page=manage_roles");
                exit;
            }
        }

        // Get all users for the role management table
        try {
            $stmt = $this->pdo->query("SELECT user_id, username, email, role FROM user ORDER BY username");
            $users = $stmt->fetchAll();

            // Create view and display the manage roles page
            $view = new \App\View\View();
            $view->display('manage_roles.php', [
                'users' => $users,
                'error_message' => $_SESSION['error_message'] ?? null,
                'success_message' => $_SESSION['success_message'] ?? null,
                'pageTitle' => 'Manage User Roles',
                'additionalCss' => [
                    '/userv2/gestion_user/assets/css/admin.css'
                ]
            ]);

            // Clear session messages
            unset($_SESSION['error_message'], $_SESSION['success_message']);
        } catch (PDOException $e) {
            error_log("Error fetching users for role management: " . $e->getMessage());
            $_SESSION['error_message'] = "Error loading users.";
            header("Location: index.php?page=admin_dashboard");
            exit;
        }
    }
}