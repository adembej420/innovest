<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and has a pending 2FA verification
if (!isset($_SESSION['temp_user_id']) || !isset($_SESSION['2fa_code'])) {
    header('Location: index.php?page=login');
    exit;
}

// Set page title and assets
$pageTitle = "Two-Factor Authentication";
$additionalCss = [
    '/userv2/gestion_user/assets/css/login.css'
];
$additionalJs = ['/userv2/gestion_user/assets/js/verify_2fa.js'];

// Get error and success messages from session
$error_message = $_SESSION['error_message'] ?? null;
$success_message = $_SESSION['success_message'] ?? null;

// Clear session messages
unset($_SESSION['error_message'], $_SESSION['success_message']);

// Include the 2FA verification template
include_once __DIR__ . '/verify_2fa_template.php';