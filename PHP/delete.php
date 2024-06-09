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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <!-- Inclure jQuery pour faciliter l'utilisation de l'API -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
    $("#submit-button").on("click", function(event) {
        $("#card-container").empty();
        event.preventDefault();
        var pokemon = $("#search").val().trim();

        if (pokemon === "") {
            alert("Veuillez entrer un nom de Pokémon.");
            return;
        }

        $.ajax({
            method: "GET",
            url: "https://api.pokemontcg.io/v1/cards?name=" + pokemon,
            success: function(response) {
                if (response.cards && response.cards.length > 0) {
                    for (var i = 0; i < response.cards.length; i++) {
                        var pokemonCard = $("<img class='pkmn-card'>");
                        pokemonCard.attr("src", response.cards[i].imageUrlHiRes);
                        pokemonCard.data("card-id", response.cards[i].id);
                        $("#card-container").append(pokemonCard);
                    }
                    
                    // Ajouter un gestionnaire d'événements clic pour chaque carte Pokémon après qu'elles soient chargées
                    $(".pkmn-card").on("click", function() {
                        var cardId = $(this).data("card-id");
                        $.ajax({
                            method: "POST",
                            url: "del.php",
                            data: { cardId: cardId },
                            success: function(response) {
                                console.log("ID de la carte supprimée avec succès !");
                                location.reload(); // Recharger la page pour mettre à jour les cartes affichées
                            },
                            error: function(xhr, status, error) {
                                console.error("Erreur lors de la suppression de l'ID de la carte :", error);
                            }
                        });
                    });
                } else {
                    console.log("Aucune carte trouvée pour ce nom de Pokémon.");
                    alert("Aucune carte trouvée pour ce nom de Pokémon.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors de la récupération des cartes :", error);
                alert("Erreur lors de la récupération des cartes. Veuillez réessayer.");
            }
        });
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
