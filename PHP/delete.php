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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/delete.css">
    <title>Mes cartes</title>
</head>

<body>
    <header>
        <a href="../index.php"><img src="../ASSET/CARDBINDEX V4.png" alt="LOGO"></a>
        <a id="param" href="compte.php"><img src="../ASSET/PARAMETRE.png"></a>
    </header>
    <div class="button-container">
        <a id="delete" href="cartes.php">Retourner dans le classeur</a>
    </div>
    <div class="rectangle-9">
        <div class="flex-row-b">
            <div class="container">
                <div class="row" id="card-container">

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let userCards = <?php echo $userCardsJson; ?>;

            userCards.forEach(function(cardId) {
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "https://api.pokemontcg.io/v1/cards?id=" + cardId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let response = JSON.parse(xhr.responseText);
                            if (response.cards && response.cards.length > 0) {
                                let card = response.cards[0];
                                let cardContainer = document.getElementById('card-container');
                                let cardElement = document.createElement('div');
                                cardElement.className = 'col-md-4 pkmn-card';
                                let imgElement = document.createElement('img');
                                imgElement.setAttribute('src', card.imageUrl);
                                imgElement.setAttribute('data-card-id', card.id);
                                imgElement.className = 'pkmn-card';
                                cardElement.appendChild(imgElement);
                                cardContainer.appendChild(cardElement);
                            }
                        } else {
                            console.error("Erreur lors de la récupération de la carte avec l'id " + cardId + ":", xhr.statusText);
                        }
                    }
                };
                xhr.send();
            });

            document.addEventListener("click", function(event) {
                if (event.target.classList.contains("pkmn-card")) {
                    console.log("ID de la carte :", event.target.getAttribute('data-card-id'));
                    let cardId = event.target.getAttribute('data-card-id');
                    let cardContainer = event.target.closest('.col-md-4'); // Récupérer le parent avec la classe 'col-md-4'
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "del.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log("ID de la carte supprimée avec succès !");
                                cardContainer.remove(); // Supprimer le parent de l'image du DOM
                            } else {
                                console.error("Erreur lors de la suppression de l'ID de la carte :", xhr.statusText);
                            }
                        }
                    };
                    xhr.send("cardId=" + cardId);
                }
            });
        });
    </script>
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
</body>

</html>