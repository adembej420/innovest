<?php
// Set the HTTP response code to 404
http_response_code(404);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 5em;
            margin-bottom: 20px;
            color: #e74c3c;
        }
        p {
            font-size: 1.5em;
            margin-bottom: 30px;
        }
        a {
            font-size: 1.2em;
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>404</h1>
    <p>Oops! The page you're looking for doesn't exist.</p>
    <a href="index.php">Go Back to Home</a>
</div>

</body>
</html>
