<?php
include 'db.php';


if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([':id' => $delete_id]);

   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$sql = "SELECT id, q, r FROM captcha";
$stmt = $dbh->query($sql); 
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
            background-color: #007bff;
            color: white;
        }
        .action-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            display: inline;
        }
        .action-button:hover {
            background-color: #c82333;
        }
        .action-form {
            display: inline;
            margin: 0;
            padding: 0;
        }
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
      
        while ($row = $stmt->fetch()) {
            echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["q"]) . "</td>
                <td>" . htmlspecialchars($row["r"]) . "</td>
                <td>
                    <form method='post' action='' class='action-form'>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($row["id"]) . "'>
                        <button type='submit' class='action-button'>Supprimer</button>
                    </form>
                </td>
            </tr>";
        }
    } else {
      
        echo "<tr><td colspan='4'>0 résultats</td></tr>";
    }
    ?>
</table>

</body>
</html>
