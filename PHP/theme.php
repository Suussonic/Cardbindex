<?php
global $dbh;
session_start();
include_once('db.php');

if (isset($_SESSION['id'])) { // Utiliser l'ID de l'utilisateur stocké dans la session
    $userId = $_SESSION['id']; // Assurez-vous que l'ID de l'utilisateur est bien stocké dans la session

    // Préparez une requête pour obtenir le thème de l'utilisateur
    $getUser = "SELECT theme FROM users WHERE id = :id";
    
    $preparedGetUser = $dbh->prepare($getUser);
    $preparedGetUser->execute([
        'id' => $userId
    ]);

    // Récupérez le résultat de la requête
    $result = $preparedGetUser->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['theme'] == 1) { // Vérifiez la valeur du thème (0 ou 1)
        echo '<link rel="stylesheet" href="../CSS/white.css">';
    } else {
        echo '<link rel="stylesheet" href="../CSS/black.css">';
    }
} else {
    // Si l'utilisateur n'est pas connecté, utilisez le thème par défaut (noir)
    echo '<link rel="stylesheet" href="../CSS/black.css">';
}
?>
