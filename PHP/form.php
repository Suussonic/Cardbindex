<?php

require_once('db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/createaccounte.css">
    <?php include './theme.php'; ?>
    <title>Inscription</title>
</head>
<body>

<div class="main-container">
    <form action="createAccount.php" method="POST">
        <h1>Inscription :</h1>
        <div>
            <input id="firstname" type="text" name="firstname" placeholder="Pseudo">
        </div>
        <div>
            <input id="lastname" type="text" name="lastname" placeholder="Nom" require>
        </div>
        <div>
            <input id="email" placeholder="Mail" type="email" name="email" require>
        </div>
        <div>
            <input id="password" type="password" name="password" placeholder="Mot de passe" require>
        </div>
        <div id="radio">
            <label for="man">Homme</label>
            <input id="man" type="radio" name="gender" value="man">

            <label for="woman">Femme</label>
            <input id="woman" type="radio" name="gender" value="woman">

            <label for="other">Autre</label>
            <input id="other" type="radio" name="gender" value="other">
        </div>
        <div id="captcha-box">
            <label for="captcha" class="captcha-label">150 + 50 = ?</label>
            <input type="text" id="captcha-input" placeholder="Votre réponse" name="captcha_input" require>
        </div>
        <label for="captcha"><a href="condition.php" target="blank">Accepter le contrat d'utilisation.</a></label>
            <input type="checkbox" id="captcha" class="hidden-checkbox" require>
        <input class="btn" type="submit">
</div>
</form>
</body>
</html>

