<?php
namespace App\Controller;

use PDO;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TwoFactorController {
    private $pdo;
    private $mailer;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->initializeMailer();
    }

    private function initializeMailer() {
        $this->mailer = new PHPMailer(true);
        
        // Server settings
        $this->mailer->isSMTP();
        $this->mailer->Host = 'localhost';
        $this->mailer->Port = 1025; // Mailhog port
        $this->mailer->SMTPAuth = false;
        
        // Default sender
        $this->mailer->setFrom('noreply@usermanagement.com', 'User Management System');
    }

    public function generateVerificationCode() {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function sendVerificationCode($email, $code) {
        try {
            $this->mailer->addAddress($email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Your Verification Code';
            
            $body = "
                <h2>Your Verification Code</h2>
                <p>Please use the following code to complete your login:</p>
                <h1 style='font-size: 32px; color: #3498db;'>{$code}</h1>
                <p>This code will expire in 10 minutes.</p>
                <p>If you didn't request this code, please ignore this email.</p>
            ";
            
            $this->mailer->Body = $body;
            $this->mailer->send();
            
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: " . $e->getMessage());
            return false;
        }
    }

    public function verifyCode($userId, $code) {
        if (!isset($_SESSION['2fa_code']) || !isset($_SESSION['2fa_expires'])) {
            return false;
        }

        if (time() > $_SESSION['2fa_expires']) {
            unset($_SESSION['2fa_code']);
            unset($_SESSION['2fa_expires']);
            return false;
        }

        return $_SESSION['2fa_code'] === $code;
    }

    public function logActivity($userId, $activityType, $description = '') {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO user_activity (user_id, activity_type, description)
                VALUES (?, ?, ?)
            ");
            
            return $stmt->execute([$userId, $activityType, $description]);
        } catch (PDOException $e) {
            error_log("Activity Log Error: " . $e->getMessage());
            return false;
        }
    }
}
?> 