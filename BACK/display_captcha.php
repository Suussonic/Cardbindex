<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

// Définir la requête SQL pour récupérer les données de la table captcha
$sql = "SELECT id, q, r FROM captcha";
$stmt = $dbh->query($sql); // Exécuter la requête
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage du Captcha</title>
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table, .admin-table th, .admin-table td {
            border: 1px solid black;
        }
        .admin-table th, .admin-table td {
            padding: 8px;
            text-align: left;
        }
        .admin-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Q</th>
        <th>R</th>
    </tr>
    <?php
    if ($stmt->rowCount() > 0) {
        // Afficher les données de chaque ligne
        while ($row = $stmt->fetch()) {
            echo "<tr><td>" . htmlspecialchars($row["id"]) . "</td><td>" . htmlspecialchars($row["q"]) . "</td><td>" . htmlspecialchars($row["r"]) . "</td></tr>";
        }
    } else {
        // Si aucun enregistrement n'est trouvé, afficher un message
        echo "<tr><td colspan='3'>0 résultats</td></tr>";  }
    ?>
</table>

</body>
</html>
