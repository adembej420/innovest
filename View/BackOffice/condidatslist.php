<?php
require_once '../../Controller/CondidatsC.php';
$controller = new CondidatsC();
$condidats = $controller->listCondidats();
?>

<table border="1">
    <tr>
        <th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>LinkedIn</th><th>Portfolio</th>
        <th>Lettre de motivation</th><th>CV</th><th>Date d'enregistrement</th><th>Actions</th>
    </tr>
    <?php foreach ($condidats as $c) : ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['nom'] ?></td>
        <td><?= $c['prenom'] ?></td>
        <td><?= $c['email'] ?></td>
        <td><?= $c['telephone'] ?></td>
        <td><?= $c['linkedin'] ?></td>
        <td><?= $c['portfolio'] ?></td>
        <td><?= $c['lettre_motivation'] ?></td>
        <td><?= $c['cv'] ?></td>
        <td><?= $c['date_enregistrement'] ?></td>
        <td>
            <a href="updateCondidat.php?id=<?= $c['id'] ?>">Update</a> |
            <a href="deleteCondidat.php?id=<?= $c['id'] ?>" onclick="return confirm('Supprimer ce condidat ?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
