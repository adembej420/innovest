<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify controller file exists
$controllerPath = '../../Controller/CondidatsSkillsC.php';
if (!file_exists($controllerPath)) {
    die("Error: Controller file not found at $controllerPath");
}

require_once $controllerPath;

// Check if skill ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No skill ID provided.");
}

try {
    $controller = new CondidatsSkillsC();
    $skill_id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Validate ID as integer

    if ($skill_id === false) {
        die("Error: Invalid skill ID.");
    }

    // Attempt to delete the skill
    $controller->deleteCondidatsSkills($skill_id);

    // Redirect back to the dashboard with a success message
    header("Location: index.php?message=Skill deleted successfully");
    exit();
} catch (Exception $e) {
    // Display error message if deletion fails
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><a href='index.php'>Return to Dashboard</a></p>";
}
?>