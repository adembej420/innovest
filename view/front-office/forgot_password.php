<?php
// Set page title and assets
$pageTitle = "Forgot Password";
$additionalCss = [
    '/userv2/gestion_user/assets/css/login.css'
];
$additionalJs = ['/userv2/gestion_user/assets/js/forgot_password.js'];

// Get error and success messages from session
$error_message = $_SESSION['error_message'] ?? null;
$success_message = $_SESSION['success_message'] ?? null;

// Clear session messages
unset($_SESSION['error_message'], $_SESSION['success_message']);

// Include the forgot password template
include_once __DIR__ . '/forgot_password_template.php';
