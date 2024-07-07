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

if (isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $update_q = $_POST['update_q'];
    $update_r = $_POST['update_r'];
    $update_sql = "UPDATE captcha SET q = :q, r = :r WHERE id = :id";
    $stmt = $dbh->prepare($update_sql);
    $stmt->execute([':q' => $update_q, ':r' => $update_r, ':id' => $update_id]);

   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


if (isset($_POST['add_q']) && isset($_POST['add_r'])) {
    $add_q = $_POST['add_q'];
    $add_r = $_POST['add_r'];
    $add_sql = "INSERT INTO captcha (q, r) VALUES (:q, :r)";
    $stmt = $dbh->prepare($add_sql);
    $stmt->execute([':q' => $add_q, ':r' => $add_r]);

    
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
    <title>Gestion des Captchas</title>
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .edit-button {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            display: inline;
        }
        .edit-button:hover {
            background-color: #e0a800;
        }
        .add-form, .edit-form {
            margin-top: 20px;
        }
        .add-form input, .edit-form input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Ajouter un nouveau Captcha</h2>
<form method="post" action="" class="add-form">
    <label for="add_q">Q:</label>
    <input type="text" id="add_q" name="add_q" required>
    <br>
    <label for="add_r">R:</label>
    <input type="text" id="add_r" name="add_r" required>
    <br>
    <button type="submit" class="edit-button">Ajouter</button>
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
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["q"]) . "</td>
                <td>" . htmlspecialchars($row["r"]) . "</td>
                <td>
                    <form method='post' action='' class='action-form'>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($row["id"]) . "'>
                        <button type='submit' class='action-button'>Supprimer</button>
                    </form>
                    <form method='post' action='' class='action-form'>
                        <input type='hidden' name='edit_id' value='" . htmlspecialchars($row["id"]) . "'>
                        <button type='submit' class='edit-button'>Modifier</button>
                    </form>
                </td>
            </tr>";
        }
    } else {
        
        echo "<tr><td colspan='4'>0 résultats</td></tr>";
    }
    ?>
</table>

<?php
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT id, q, r FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':id' => $edit_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo "
        <h2>Modifier l'entrée</h2>
        <form method='post' action='' class='edit-form'>
            <input type='hidden' name='update_id' value='" . htmlspecialchars($row["id"]) . "'>
            <label for='update_q'>Q:</label>
            <input type='text' id='update_q' name='update_q' value='" . htmlspecialchars($row["q"]) . "' required>
            <br>
            <label for='update_r'>R:</label>
            <input type='text' id='update_r' name='update_r' value='" . htmlspecialchars($row["r"]) . "' required>
            <br>
            <button type='submit' class='edit-button'>Enregistrer</button>
        </form>
        ";
    }
}
?>

</body>
</html>
