<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

// Handle deletion
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([':id' => $delete_id]);
}

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
    
    </style>
</head>
<body>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Q</th>
        <th>R</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($stmt->rowCount() > 0) {
        // Afficher les données de chaque ligne
        while ($row = $stmt->fetch()) {
            echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["q"]) . "</td>
                <td>" . htmlspecialchars($row["r"]) . "</td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($row["id"]) . "'>
                        <button type='submit' class='action-button'>Supprimer</button>
                    </form>
                </td>
            </tr>";
        }
    } else {
        // Si aucun enregistrement n'est trouvé, afficher un message
        echo "<tr><td colspan='4'>0 résultats</td></tr>";
    }
    ?>
</table>

</body>
</html>
