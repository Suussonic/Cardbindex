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
    <div class="container">
        <button class="block" id="scarlet-violet"><img src="../ASSET/SCARLETVIOLET.png" alt="Scarlet & Violet"></button>
        <button class="block" id="sword-shield"><img src="X" alt="Sword & Shield"></button>
        <button class="block" id="sun-moon"><img src="X" alt="Sun & Moon"></button>
        <button class="block" id="xy"><img src="X" alt="XY"></button>
        <button class="block" id="black-white"><img src="X" alt="Black & White"></button>
        <button class="block" id="heartgold-soulsilver"><img src="X" alt="HeartGold SoulSilver"></button>
        <button class="block" id="platinum"><img src="X" alt="Platinum"></button>
        <button class="block" id="diamond-pearl"><img src="X" alt="Diamond & Pearl"></button>
        <button class="block" id="pokemon-organized-play"><img src="X" alt="Pokemon Organized Play"></button>
    </div>
</body>
</html>
