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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/cartes.css">
    <title>Mes cartes</title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="rectangle-5">
        <div class="flex-row-ed">
            <span class="nombre-de-carte">Nombre de carte<br />000 / 000</span>
            <span class="estimation-totale">Estimation totale<br />00.00€</span>
        </div>
    </div>
    <div class="button-container">
        <a id="delete" href="delete.php">Supprimer des cartes</a>
    </div>
    <div class="rectangle-9">
        <div class="flex-row-b">
            <div class="container">
                <div class="row" id="card-container">

                </div>
            </div>
        </div>
    </div>
    </div>
    <footer>
        <div id="Credit">
            <p>© 2024 Pokémon. © 1995–2024 Nintendo/Creatures Inc./GAME FREAK Inc. est une marque déposée par Nintendo</p>
            <p>© 2024, CardBinDex. Les autres marques, images ou noms de produit appartiennent à leurs propriétaires respectifs.</p>
        </div>
        <div id="Lien">
            <h2>Nous Contacter</h2>
            <h2>projet.annuel3tan@gmail.com</h2>
            <h2>Nos réseaux :</h2>
            <a href="https://twitter.com/cardbindex" target="_blank"><img src="../ASSET/X.png" alt="TWITTER" width="24px" height="24px"></a>
            <a href="https://twitter.com/cardbindex" target="_blank"><img src="../ASSET/DISCORD.png" alt="DISCORD" width="24px" height="24px"></a>
            <a href="https://twitter.com/cardbindex" target="_blank"><img src="../ASSET/INSTAGRAM.png" alt="INSTAGRAM" width="24px" height="24px"></a>
            <a href="https://github.com/Suussonic/CardBinDex" target="_blank"><img src="../ASSET/GITHUB.png" alt="GITHUB" width="24px" height="24px"></a>
        </div>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let userCards = <?php echo $userCardsJson; ?>;
            userCards.forEach(function(cardId) {
                fetch("https://api.pokemontcg.io/v1/cards/" + cardId)
                    .then(response => response.json())
                    .then(function(response) {
                        if (response.card) {
                            let cardImg = document.createElement("img");
                            cardImg.className = "pkmn-card";
                            cardImg.src = response.card.imageUrlHiRes;
                            document.getElementById("card-container").appendChild(cardImg);
                        } else {
                            console.error("Aucune carte trouvée avec l'ID " + cardId);
                        }
                    })
                    .catch(function(error) {
                        console.error("Erreur lors de la récupération de la carte avec l'id " + cardId + ":", error);
                    });
            });
        });
    </script>
</body>

</html>
