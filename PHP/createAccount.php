<?php
global $dbh;
require_once('../db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
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

    <h1>Votre compte a bien été créé</h1>
</body>
</html>
<?php

$firstname = $_POST['pseudo'];
$email = $_POST['email'];
$pass = $_POST['password'];

$passHash = password_hash($pass, PASSWORD_BCRYPT);

$insertUser = "
INSERT INTO users (pseudo, email, mdp)
VALUES (:firstname, :email, :password)
";

$preparedQuery = $dbh->prepare($insertUser);
$preparedQuery->execute([
    'firstname' => $firstname,
    'email' => $email,
    'password' => $passHash,
]);
