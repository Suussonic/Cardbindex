<?php
global $dbh;
require_once('db.php');

$errorInfo = false;

if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $loginSql = 'SELECT * FROM users WHERE pseudo = :pseudo';

    $preparedLoginRequest = $dbh->prepare($loginSql);
    $preparedLoginRequest->execute(['pseudo' => $pseudo]);

    $user = $preparedLoginRequest->fetch();

    if (password_verify($password, $users['mdp'])) {
        session_start();
        $_SESSION['email'] = $users['email'];

        header('location:account.php');
    } else {
        $errorInfo = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="form.php">Créer compte</a></li>
                <li><a href="loginForm.php">Login</a></li>
                <li><a href="account/account.php">Mon compte</a></li>
                <li><a href="logout.php">Se deconnecter</a></li>
            </ul>

        </nav>
    </header>
    <h1>Identifiez vous</h1>
    <?php
        if ($errorInfo) {
            echo "<p class='error'>Mauvais credentials</p>";
        }
    ?>
    <form action="loginForm.php" method="POST">
        <div>
            <label for="email">Pseudo</label>
            <input id="email" type="text" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required>
        </div>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>