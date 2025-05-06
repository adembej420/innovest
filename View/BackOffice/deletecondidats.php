<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify controller file exists
$controllerPath = '../../Controller/CondidatsC.php';
if (!file_exists($controllerPath)) {
    die("Error: Controller file not found at $controllerPath");
}

require_once $controllerPath;

// Check if ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No candidate ID provided.");
}

try {
    $controller = new CondidatsC();
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Validate ID as integer

    if ($id === false) {
        die("Error: Invalid candidate ID.");
    }

    // Attempt to delete the candidate
    $controller->deleteCondidats($id);

    // Redirect back to the tables page with a success message
    header("Location: tables.php?message=Candidate deleted successfully");
    exit();
} catch (Exception $e) {
    // Display error message if deletion fails
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><a href='tables.php'>Return to Candidates List</a></p>";
}
?>