<header>
    <a href="/index.php"><img src="/ASSET/CARDBINDEX V4.png" alt="LOGO"></a>
    <a href="../recherche/recherche.html">Rechercher</a>
    <?php
    session_start();
    if (isset($_SESSION['firstname'])) {
        echo '<a id="param" href="PHP/compte.php"><img src="/ASSET/PARAMETRE.png"></a>';
        $userId = $_SESSION['userId'];
    
        $getUser = "SELECT rol FROM users WHERE id = :id";
        
        $preparedGetUser = $dbh->prepare($getUser);
        $preparedGetUser->execute([
            'id' => $userId
        ]);
    
        $result = $preparedGetUser->fetch(PDO::FETCH_ASSOC);
        if ($result['theme'] == "admin") { 
            echo '<a class="Connexion" href="BACK/logs.php">Back</a>';
        }
    } else {
        echo '<a class="Connexion" href="PHP/loginForm.php">Se Connecter</a>';
    }
   ?>
</header>
