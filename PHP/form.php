<?php

require_once('../db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CardBinDex/CSS/caccount.css">
    <title>Ce créer un compte</title>
</head>
<body>

<h1>Formulaire de creation</h1>

<div class="main-container">
    <form action="createAccount.php" method="POST">
        <div>
            <label for="firstname">Pseudo</label>
            <input id="firstname" type="text" name="firstname" placeholder="Prenom">
        </div>
        <div>
            <label for="lastname">Nom</label>
            <input id="lastname" type="text" name="lastname" require>
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" require>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" require>
        </div>
        <div>
            <label for="man">Homme</label>
            <input id="man" type="radio" name="gender" value="man">

            <label for="woman">Femme</label>
            <input id="woman" type="radio" name="gender" value="woman">

            <label for="other">Autre</label>
            <input id="other" type="radio" name="gender" value="other">
        </div>
        <div class="captcha-box">
            <label for="captcha">Accepter le contrat d'utilisation.</label>
            <input type="checkbox" id="captcha" class="hidden-checkbox" require>
            <label for="captcha" class="captcha-label">150 + 50 = ?</label>
            <input type="text" id="captcha-input" placeholder="Votre réponse" name="captcha_input" require>
        </div>
        <input type="submit">
</div>
</form>
</body>
</html>

