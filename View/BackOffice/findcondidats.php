<?php
function searchcondidats($pdo, $searchTerm) {
    $stmt = $pdo->prepare("
        SELECT c.*, cand.nom, cand.prenom 
        FROM condidats c
        JOIN candidats cand ON c.candidat_id = cand.id
        WHERE cand.nom LIKE ? OR cand.prenom LIKE ? OR c.statut = ?
    ");
    $stmt->execute(["%$searchTerm%", "%$searchTerm%", $searchTerm]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Utilisation
$results = searchcondidats($pdo, 'Dupont');
print_r($results);
?>