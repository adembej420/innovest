<?php
// Include the controller file - adjust the path as needed
require_once __DIR__ . '/../../Controller/condidatsC.php';

// Create an instance of the controller
$candidateController = new condidatsC();

// Now you can safely call methods on the controller
try {
    $liste = $candidateController->listCondidats();
    
    // Display the results
    echo "<h1>List of Candidates</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Telephone</th></tr>";
    
    foreach ($liste as $candidate) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($candidate['id']) . "</td>";
        echo "<td>" . htmlspecialchars($candidate['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($candidate['prenom']) . "</td>";
        echo "<td>" . htmlspecialchars($candidate['email']) . "</td>";
        echo "<td>" . htmlspecialchars($candidate['telephone']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} 
?>