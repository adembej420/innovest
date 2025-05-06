<?php
require 'C:/xampp/htdocs/innovest/View/BackOffice/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidatId = $_POST['candidat_id'];
    $posteId = $_POST['poste_id'];
    $cvPath = '/uploads/' . basename($_FILES['cv']['name']);
    $lettre = $_POST['lettre_motivation'];

    // Déplacer le fichier uploadé
    move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO condidats 
            (candidat_id, poste_id, cv_path, lettre_motivation, statut) 
            VALUES (?, ?, ?, ?, 'nouvelle')
        ");
        $stmt->execute([$candidatId, $posteId, $cvPath, $lettre]);
        
        echo "Candidature enregistrée ! ID : " . $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>