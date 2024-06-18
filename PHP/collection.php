<?php
session_start();
// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['userId'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: loginForm.php');
    exit; // Arrêter l'exécution du script
}

// Récupérer les id_cartes pour l'utilisateur connecté depuis la base de données
$getUserCardsSql = "SELECT id_carte FROM classeur WHERE firstname = :firstname";
$preparedGetUserCards = $dbh->prepare($getUserCardsSql);
$preparedGetUserCards->execute(['firstname' => $_SESSION['firstname']]);
$userCards = $preparedGetUserCards->fetchAll(PDO::FETCH_COLUMN);

// Convertir le tableau PHP en chaîne JSON pour l'utiliser dans JavaScript
$userCardsJson = json_encode($userCards);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <title>Pokemon Blocks</title>
    <link rel="stylesheet" href="../CSS/collection.css">
    <?php include './theme.php'; ?>
</head>
<body>
    <?php include 'PHP/nav.php'; ?>
    <div class="GALERIE">
        <h2>Séries</h2>
        <div class="galerie">
            <div class="item"><a href="" target="_blank"><img src="../ASSET/XY.png" alt="XY"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/SWSH1.png" alt="SWSH1"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/SVI.png" alt="SVI"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/SM01.png" alt="SM01"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/PT.png" alt="PT"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/HGSS.png" alt="HGSS"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/DP.png" alt="DP"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/CL.png" alt="CL"></a></div>
            <div class="item"><a href="" target="_blank"><img src="../ASSET/BLW.png" alt="BLW"></a></div>
        </div>
    </div>
</body>
</html>
