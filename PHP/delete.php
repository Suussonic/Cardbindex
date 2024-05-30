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
    <link rel="stylesheet" href="../CSS/cartes.css">
    <title>Mes cartes</title>
</head>
<body>
    <header>
        <a href="../index.php"><img src="../ASSET/CARDBINDEX V4.png" alt="LOGO"></a>
        <a id="param" href="compte.php"><img src="../ASSET/PARAMETRE.png"></a>
    </header>
    <div class="rectangle-5">
      <div class="button-container">
        <a id="delete" href="delete.php">Retourner dans le classeur</a>
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
            // Récupérer les id_cartes de l'utilisateur à partir de la chaîne JSON
            var userCards = <?php echo $userCardsJson; ?>;
            
            // Parcourir les id_cartes et les afficher en utilisant l'API
            userCards.forEach(function(cardId) {
                $.ajax({
                    method: "GET",
                    url: "https://api.pokemontcg.io/v1/cards/" + cardId,
                    success: function(response) {
                        // Créer une balise <img> pour chaque carte et l'ajouter au conteneur
                        var cardImg = $("<img class='pkmn-card'>").attr("src", response.card.imageUrlHiRes);
                        $("#card-container").append(cardImg);
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur lors de la récupération de la carte avec l'id " + cardId + ":", error);
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
