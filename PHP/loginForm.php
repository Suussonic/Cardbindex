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

        header('location:../CardBinDex/index.php');
    } else {
        $errorInfo = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CardBinDex/CSS/connexion.css">
    <title>Connexion</title>
</head>
<body>
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
    <a href="../register/form.php">Créer compte</a>
</body>
</html>