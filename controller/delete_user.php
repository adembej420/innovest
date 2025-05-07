// delete_user.php

<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Prepare the delete query
$stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);

// Logout after deletion
session_unset();
session_destroy();

echo "Your account has been deleted.";
echo "<a href='index.php'>Go to Login Page</a>";
?>
