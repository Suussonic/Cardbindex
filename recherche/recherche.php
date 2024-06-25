<?php
global $dbh;
session_start();
require_once('../PHP/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Code de mise à jour de l'utilisateur...
}

// Récupération des informations de l'utilisateur
$getUser = "SELECT id, firstname, lastname, email, gender FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
    'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch();

// Récupération de l'ID de l'utilisateur
$userId = $user['id'];

// Utilisation de l'ID récupéré
echo "L'ID de l'utilisateur est : $userId";

$cardId = $_POST["cardId"];
$insertUser = "
INSERT INTO classeur (id_user, id_carte)
VALUES (:userId, :cardId)
";

$preparedQuery = $dbh->prepare($insertUser);
$preparedQuery->execute([
    'cardId' => $cardId,
    'userId' => $userId,
]);
?>
