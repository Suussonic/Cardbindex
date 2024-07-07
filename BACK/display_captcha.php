

<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

// Handle deletion
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([':id' => $delete_id]);
}

// Handle addition
if (isset($_POST['add_q']) && isset($_POST['add_r'])) {
    $add_q = $_POST['add_q'];
    $add_r = $_POST['add_r'];
    $add_sql = "INSERT INTO captcha (q, r) VALUES (:q, :r)";
    $stmt = $dbh->prepare($add_sql);
    $stmt->execute([':q' => $add_q, ':r' => $add_r]);
}

// Handle update
if (isset($_POST['edit_id']) && isset($_POST['edit_q']) && isset($_POST['edit_r'])) {
    $edit_id = $_POST['edit_id'];
    $edit_q = $_POST['edit_q'];
    $edit_r = $_POST['edit_r'];
    $edit_sql = "UPDATE captcha SET q = :q, r = :r WHERE id = :id";
    $stmt = $dbh->prepare($edit_sql);
    $stmt->execute([':q' => $edit_q, ':r' => $edit_r, ':id' => $edit_id]);
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

<h2>Ajouter un nouveau Captcha</h2>
<form method="post" action="">
    <label for="add_q">Q:</label>
    <input type="text" id="add_q" name="add_q" required>
    <label for="add_r">R:</label>
    <input type="text" id="add_r" name="add_r" required>
    <button type="submit">Ajouter</button>
</form>

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
                    <form method='post' action='' style='display:inline-block;'>
                        <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                        <button type='submit'>Supprimer</button>
                    </form>
                    <form method='post' action='' style='display:inline-block;'>
                        <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                        <input type='text' name='edit_q' value='" . htmlspecialchars($row["q"]) . "' required>
                        <input type='text' name='edit_r' value='" . htmlspecialchars($row["r"]) . "' required>
                        <button type='submit'>Modifier</button>
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
