<?php
// This file is now just a wrapper that redirects to the proper controller method
// It should not be accessed directly

// Check if we're being accessed directly
if (!defined('LAYOUT_INCLUDED')) {
    // If accessed directly, redirect to the proper route
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Redirect to the profile route
    header("Location: /userv2/gestion_user/public/index.php?page=profile");
    exit;
}

// Get user data from the controller or session
$profile_photo = (!empty($_SESSION['profile_photo'])) ? $_SESSION['profile_photo'] : 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y';
$username = $_SESSION['username'] ?? 'User';
$firstName = $_SESSION['first_name'] ?? '';
$lastName = $_SESSION['last_name'] ?? '';
$phone = $_SESSION['phone'] ?? 'Not set';
$email = $_SESSION['email'] ?? 'Not set';
$created_at = isset($_SESSION['created_at']) ? date("F Y", strtotime($_SESSION['created_at'])) : 'Not available';

// Get activities if available
$activities = $activities ?? [];

// Include the profile template
include_once __DIR__ . '/profile_template.php';
?>

