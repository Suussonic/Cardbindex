<?php
require_once('db.php');

// Function to fetch a random captcha question and answer from the database
function getRandomCaptchaData($dbh) {
    $query = "SELECT q, r FROM captcha_table ORDER BY RAND() LIMIT 1";
    $statement = $dbh->prepare($query);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

session_start();
$captchaData = getRandomCaptchaData($dbh);
$_SESSION['captcha_answer'] = $captchaData['r'];
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
    <?php if (isset($_GET['error'])){ ?>
        <h1><?php echo $_GET['error']; ?> </h1>
    <?php } ?>
    <form action="createAccount.php" method="POST">
        <h1>Inscription :</h1>
        <div>
            <input id="firstname" type="text" name="firstname" placeholder="Pseudo" required>
        </div>
        <div>
            <input id="lastname" type="text" name="lastname" placeholder="Nom" required>
        </div>
        <div>
            <input id="email" placeholder="Mail" type="email" name="email" required>
        </div>
        <div>
            <input id="password" type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <div id="radio">
            <label for="man">Homme</label>
            <input id="man" type="radio" name="gender" value="man" required>

            <label for="woman">Femme</label>
            <input id="woman" type="radio" name="gender" value="woman" required>

            <label for="other">Autre</label>
            <input id="other" type="radio" name="gender" value="other" required>
        </div>
        <div id="captcha-box">
            <label for="captcha_input" class="captcha-label"><?= $captchaData['q']; ?> = ?</label>
            <input type="text" id="captcha-input" placeholder="Votre réponse" name="captcha_input" required>
        </div>
        <label for="terms"><a href="condition.php" target="blank">Accepter le contrat d'utilisation.</a></label>
            <input type="checkbox" id="terms" class="hidden-checkbox" required>
        <input class="btn" type="submit">
    </form>
</div>
</body>
</html>
