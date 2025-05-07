<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../controller/SearchController.php';

header('Content-Type: application/json');

// Check if it's an AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $searchController = new SearchController($pdo);
    
    if (isset($_GET['query']) && !empty($_GET['query'])) {
        $results = $searchController->searchUsers($_GET['query']);
        echo json_encode($results);
    } else {
        echo json_encode(['error' => 'No search query provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?> 