<?php
// db.php


$host = 'localhost';          // Database host
$dbname = 'gestion_user';     // Database name
$username = 'root';           // MySQL username (default is 'root' for XAMPP)
$password = '';               // MySQL password (empty by default on XAMPP)
$charset = 'utf8mb4';         // Charset for DB connection

// Create DSN for PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Set PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // Use native prepared statements
];

try {
    // Create PDO instance
    global $pdo;
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    error_log('Database Connection Error: ' . $e->getMessage());
    // Avoid displaying DB errors to users
    exit('A database error occurred. Please try again later.');
}

// Optional: Load auth config if available
$authConfigPath = __DIR__ . '/auth.php';
if (file_exists($authConfigPath)) {
    $authConfig = require $authConfigPath;
    $config = array_merge($config ?? [], $authConfig);
}
?>
