<?php
require 'config.php';

try {
    $stmt = $pdo->query("
        SELECT c.*, cand.nom, cand.prenom, p.titre AS poste
        FROM condidats c
        JOIN condidats cand ON c.condidat_id = cand.id
        JOIN postes p ON c.poste_id = p.id
    ");
    
    $condidats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($condidats as $condidature) {
        echo "ID: {$condidature['id']} | condidat: {$condidature['prenom']} {$condidature['nom']}";
        echo " | Poste: {$condidature['poste']} | Statut: {$condidature['statut']}<br>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>