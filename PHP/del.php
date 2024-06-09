<?php
global $dbh;
session_start();
require_once('../PHP/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardId = $_POST['cardId'];
    $deleteCard = "DELETE FROM classeur WHERE id_carte = :cardId";

    $preparedQuery = $dbh->prepare($deleteCard);
    $preparedQuery->execute(['cardId' => $cardId]);

    echo "Carte supprimée avec succès";
}
?>