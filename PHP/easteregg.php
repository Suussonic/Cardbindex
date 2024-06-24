<?php
session_start();
require_once('../PHP/db.php');

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des informations de l'utilisateur
    $getUser = "SELECT id, firstname FROM users WHERE id = :id";
    $preparedGetUser = $dbh->prepare($getUser);
    $preparedGetUser->execute(['id' => $_SESSION['user_id']]);
    $user = $preparedGetUser->fetch();

    if ($user) {
        $userId = $user['id'];
        $badgeValue = $_POST['badge_value'];

        // Insertion des données dans la base de données
        $insertBadge = "INSERT INTO badge (id, badges) VALUES (:id, :badges)";
        $preparedInsert = $dbh->prepare($insertBadge);
        $preparedInsert->execute([
            'id' => $userId,
            'badges' => $badgeValue,
        ]);

        echo "New record created successfully";
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid request method";
}
?>
