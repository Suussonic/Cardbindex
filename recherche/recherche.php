<?php
global $dbh;
session_start();
require_once('../PHP/db.php');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
}


$getUser = "SELECT id, firstname, lastname, email, gender FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
    'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch();


$firstname = $user['firstname'];


echo "Le prénom de l'utilisateur est : $firstname";

$cardId = $_POST["cardId"];
$insertUser = "
INSERT INTO classeur (firstname, id_carte)
VALUES (:firstname, :cardId)
";

$preparedQuery = $dbh->prepare($insertUser);
$preparedQuery->execute([
    'cardId' => $cardId,
    'firstname' => $firstname,
]);