<?php
// This file is now just a wrapper that redirects to the proper controller method
// It should not be accessed directly

// Check if we're being accessed directly
if (!defined('LAYOUT_INCLUDED')) {
    // If accessed directly, redirect to the proper route
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Redirect to the dashboard route
    header("Location: /userv2/gestion_user/public/index.php?page=userdashboard");
    exit;
}

// If we get here, we're being included by the controller, so just return
return;
?>