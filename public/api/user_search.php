<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Check if it's an AJAX request
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden']);
    exit;
}

// Get search query
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (empty($query) || strlen($query) < 2) {
    echo json_encode([]);
    exit;
}

try {
    // Search in user's own data
    $stmt = $pdo->prepare("
        SELECT user_id, username, email, first_name, last_name, phone
        FROM user
        WHERE user_id = ? AND (
            username LIKE ? OR
            email LIKE ? OR
            first_name LIKE ? OR
            last_name LIKE ? OR
            phone LIKE ?
        )
    ");

    $searchTerm = "%{$query}%";
    $stmt->execute([
        $_SESSION['user_id'],
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        // Remove sensitive data
        unset($result['user_id']);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
?> 