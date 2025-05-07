<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mailer;
    private $config;

    public function __construct() {
        $this->config = require __DIR__ . '/../config/mail.php';
        $this->mailer = new PHPMailer(true);
        $this->setupMailer();
    }

    private function setupMailer() {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = $this->config['host'];
            $this->mailer->Port = $this->config['port'];
            
            // No authentication needed for MailHog
            $this->mailer->SMTPAuth = false;
            
            // Debug mode
            if ($this->config['debug']) {
                $this->mailer->SMTPDebug = 2;
            }

            // Default sender
            $this->mailer->setFrom($this->config['from_address'], $this->config['from_name']);
        } catch (Exception $e) {
            error_log("Mailer setup failed: " . $e->getMessage());
            throw new Exception("Failed to setup mailer");
        }
    }

    public function sendMail($to, $subject, $body, $isHtml = true) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            
            if ($isHtml) {
                $this->mailer->isHTML(true);
                $this->mailer->Body = $body;
                $this->mailer->AltBody = strip_tags($body);
            } else {
                $this->mailer->isHTML(false);
                $this->mailer->Body = $body;
            }

            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Failed to send email: " . $e->getMessage());
            throw new Exception("Failed to send email");
        }
    }
} 