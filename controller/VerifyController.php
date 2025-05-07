<?php
namespace App\Controller;

use PDO;
use PDOException;

class VerifyController {
    private $pdo;
    private $twoFactor;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->twoFactor = new TwoFactorController($pdo);
    }

    public function verifyCode($code) {
        // Check if there's a pending 2FA verification
        if (!isset($_SESSION['temp_user_id']) || !isset($_SESSION['2fa_code'])) {
            $_SESSION['error_message'] = "Invalid verification session. Please login again.";
            header("Location: index.php?page=login");
            exit;
        }

        // Check if the code has expired
        if (isset($_SESSION['2fa_expires']) && time() > $_SESSION['2fa_expires']) {
            // Clear temporary session data
            unset($_SESSION['temp_user_id']);
            unset($_SESSION['2fa_code']);
            unset($_SESSION['2fa_expires']);

            $_SESSION['error_message'] = "Verification code has expired. Please login again.";
            header("Location: index.php?page=login");
            exit;
        }

        // Verify the code
        if ($_SESSION['2fa_code'] === $code) {
            // Get user details
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$_SESSION['temp_user_id']]);
            $user = $stmt->fetch();

            if ($user) {
                // Log user details for debugging
                error_log("2FA verification successful for user: " . $user['username'] . " (ID: " . $user['user_id'] . ")");
                error_log("User role: " . $user['role'] . ", Status: " . $user['status']);

                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Update user status to 'active'
                $stmt = $this->pdo->prepare("UPDATE user SET status = 'active' WHERE user_id = ?");
                $stmt->execute([$user['user_id']]);
                error_log("User status updated to active");

                // Clear temporary session data
                unset($_SESSION['temp_user_id']);
                unset($_SESSION['2fa_code']);
                unset($_SESSION['2fa_expires']);

                // Log successful verification
                $this->twoFactor->logActivity(
                    $user['user_id'],
                    'verification',
                    'Email verification successful'
                );

                // Set success message
                $_SESSION['success_message'] = "Login successful!";

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: index.php?page=admin_dashboard");
                } else {
                    header("Location: index.php?page=userdashboard");
                }
                exit;
            }
        }

        $_SESSION['error_message'] = "Invalid verification code. Please try again.";
        header("Location: index.php?page=verify_2fa");
        exit;
    }

    public function resendCode() {
        if (!isset($_SESSION['temp_user_id'])) {
            $_SESSION['error_message'] = "Invalid session. Please login again.";
            header("Location: index.php?page=login");
            exit;
        }

        // Get user email
        $stmt = $this->pdo->prepare("SELECT email FROM user WHERE user_id = ?");
        $stmt->execute([$_SESSION['temp_user_id']]);
        $user = $stmt->fetch();

        if ($user) {
            // Generate new code
            $code = $this->twoFactor->generateVerificationCode();
            $_SESSION['2fa_code'] = $code;
            $_SESSION['2fa_expires'] = time() + (10 * 60); // 10 minutes expiration

            // Send new code
            if ($this->twoFactor->sendVerificationCode($user['email'], $code)) {
                $_SESSION['success_message'] = "New verification code has been sent to your email.";
            } else {
                $_SESSION['error_message'] = "Failed to send verification code. Please try again.";
            }
        }

        header("Location: index.php?page=verify_2fa");
        exit;
    }
}