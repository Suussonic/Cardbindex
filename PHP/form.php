<?php

require_once('db.php');

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

<h1>Formulaire de creation</h1>

<form action="createAccount.php" method="POST">

    <input type="text" placeholder="Name" name="pseudo"/>
    <input type="email" placeholder="Email" name="email"/>
    <input type="password" placeholder="Password" name="password" />

    <input type="submit">

</form>
</body>
</html>

