<?php
session_start();
include_once('db.php');
?>
<header>
    <a href="../index.php"><img src="../ASSET/CARDBINDEX V4.png" alt="LOGO"></a>
    <a href="../recherche/recherche.html">Rechercher</a>
    <?php
    if (isset($_SESSION['firstname'])) {
        // Si l'utilisateur est connecté
        echo '<a id="param" href="PHP/compte.php"><img src="../ASSET/PARAMETRE.png"></a>';
    } else {
        // Si l'utilisateur n'est pas connecté
        echo '<a class="Connexion" href="PHP/loginForm.php">Se Connecter</a>';
    }
    ?>
</header>