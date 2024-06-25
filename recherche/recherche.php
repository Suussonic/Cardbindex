<?php
global $dbh;
session_start();
require_once('../PHP/db.php');
?>

<?php

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

// Récupération du prénom de l'utilisateur
$id = $user['userid'];

// Utilisation du prénom récupéré
echo "Le prénom de l'utilisateur est : $id";

$cardId = $_POST["cardId"];
$insertUser = "
INSERT INTO classeur (id, id_carte)
VALUES (:id, :cardId)
";

$preparedQuery = $dbh->prepare($insertUser);
$preparedQuery->execute([
    'cardId' => $cardId,
    'id' => $id,
]);