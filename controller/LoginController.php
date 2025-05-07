<?php
namespace App\Controller;

use PDO;
use PDOException;
use App\Controller\TwoFactorController;

class LoginController {
    private $pdo;
    private $twoFactor;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->twoFactor = new TwoFactorController($pdo);
    }

    public function login($usernameOrEmail, $password) {
        try {
            // First try to find user by email
            $stmt = $this->pdo->prepare("
                SELECT user_id, username, email, password, role, status
                FROM user
                WHERE email = ?
            ");

            $stmt->execute([$usernameOrEmail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // If not found by email, try by username
            if (!$user) {
                $stmt = $this->pdo->prepare("
                    SELECT user_id, username, email, password, role, status
                    FROM user
                    WHERE username = ?
                ");

                $stmt->execute([$usernameOrEmail]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            // Debug log to check user data
            error_log("Login attempt for: " . $usernameOrEmail);
            if ($user) {
                error_log("User found: " . $user['username'] . ", Status: " . $user['status']);
            } else {
                error_log("User not found");
            }

            if ($user && password_verify($password, $user['password'])) {
                // If user is not active, set to active
                if ($user['status'] !== 'active') {
                    $updateStmt = $this->pdo->prepare("UPDATE user SET status = 'active' WHERE user_id = ?");
                    $updateStmt->execute([$user['user_id']]);
                    error_log("User status updated to active: " . $user['username']);
                }

                // Generate and send 2FA code
                $code = $this->twoFactor->generateVerificationCode();
                error_log("Generated 2FA code for user: " . $user['username']);

                // Store temporary session data
                $_SESSION['temp_user_id'] = $user['user_id'];
                $_SESSION['2fa_code'] = $code;
                $_SESSION['2fa_expires'] = time() + (10 * 60); // 10 minutes expiration

                // Send verification code
                if ($this->twoFactor->sendVerificationCode($user['email'], $code)) {
                    error_log("Verification code sent to: " . $user['email']);
                    return [
                        'success' => true,
                        'message' => 'Verification code sent to your email',
                        'redirect' => 'verify_2fa'
                    ];
                } else {
                    error_log("Failed to send verification code to: " . $user['email']);
                    return [
                        'success' => false,
                        'message' => 'Failed to send verification code'
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'Invalid username or password'
            ];
        } catch (PDOException $e) {
            error_log("Login Error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred during login'
            ];
        }
    }

    public function completeLogin($userId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT user_id, username, email, first_name, last_name, role, status
                FROM user
                WHERE user_id = ? AND status = 'active'
            ");

            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Log successful login
                $this->twoFactor->logActivity(
                    $user['user_id'],
                    'login',
                    'User logged in successfully'
                );

                // Clear 2FA session data
                unset($_SESSION['temp_user_id']);
                unset($_SESSION['2fa_code']);
                unset($_SESSION['2fa_expires']);

                return [
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect' => 'dashboard'
                ];
            }

            return [
                'success' => false,
                'message' => 'User not found or inactive'
            ];
        } catch (PDOException $e) {
            error_log("Login Completion Error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred during login completion'
            ];
        }
    }
}
?>