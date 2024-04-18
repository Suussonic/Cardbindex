<?php
global $dbh;
require_once('../db.php');

$errorInfo = false;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginSql = 'SELECT * FROM users WHERE email = :email';

    $preparedLoginRequest = $dbh->prepare($loginSql);
    $preparedLoginRequest->execute(['email' => $email]);

    $user = $preparedLoginRequest->fetch();

    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['userId'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];

        header('location:../account/account.php');
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
                <li><a href="../register/form.php">Créer compte</a></li>
                <li><a href="../login/loginForm.php">Login</a></li>
                <li><a href="../account/account.php">Mon compte</a></li>
                <li><a href="../logout.php">Se deconnecter</a></li>
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
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required>
        </div>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>