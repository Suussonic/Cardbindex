<header>
    <a href="/index.php"><img src="/ASSET/CARDBINDEX V4.png" alt="LOGO"></a>
    <a href="../recherche/recherche.html">Rechercher</a>
    <?php
    if (isset($_SESSION['firstname'])) {
        echo '<a id="param" href="PHP/compte.php"><img src="/ASSET/PARAMETRE.png"></a>';
        $userId = $_SESSION['userId'];
    
        $getUser = "SELECT role FROM users WHERE id = :id";
        
        $preparedGetUser = $dbh->prepare($getUser);
        $preparedGetUser->execute([
            'id' => $userId
        ]);
    
        $result = $preparedGetUser->fetch(PDO::FETCH_ASSOC);
        if ($result['role'] == "admin") { 
            echo '<a class="Connexion" href="BACK/parametre.php">Back</a>';
        }
    } else {
        echo '<a class="Connexion" href="PHP/loginForm.php">Se Connecter</a>';
    }
   ?>
</header>
