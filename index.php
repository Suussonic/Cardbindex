<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="sUTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="CSS/Index.css">
    <?php include 'PHP/theme.php'; ?>
    <title>Accueil</title>
</head>
<body>
    <?php include 'PHP/nav.php'; ?>
    <div id="banniere">
        <img src="ASSET/HORIZON.png" alt="banniere">
    </div>
    <div>
        <nav>
            <ul>
                <li><a href="PHP/collection.php"><b>Collection</b></a></li>
                <li><a href="PHP/cartes.php">Classeur</a></li>
                <li><a href=""><b>Marcher</b></a></li>
                <li><a href=""><b>Tchat</b></a></li>
            </ul>
        </nav>
    </div>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./ASSET/CAR5.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./ASSET/CAR2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./ASSET/CAR3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./ASSET/CAR4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
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
            <a href="https://twitter.com/cardbindex" target="_blank"><img src="./ASSET/X.png" alt="TWITTER" width="24px" height="24px"></a>
            <a href="https://twitter.com/cardbindex" target="_blank"><img src="./ASSET/DISCORD.png" alt="DISCORD" width="24px" height="24px"></a>
            <a href="https://twitter.com/cardbindex" target="_blank"><img src="./ASSET/INSTAGRAM.png" alt="INSTAGRAM" width="24px" height="24px"></a>
            <a href="https://github.com/Suussonic/CardBinDex" target="_blank"><img src="./ASSET/GITHUB.png" alt="GITHUB" width="24px" height="24px"></a>
        </div>
    </footer>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>