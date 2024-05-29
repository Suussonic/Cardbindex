<?php
global $dbh;
require_once('db.php');

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
                <li><a href="form.php">Créer compte</a></li>
                <li><a href="loginForm.php">Login</a></li>
                <li><a href="account.php">Mon compte</a></li>
                <li><a href="logout.php">Se deconnecter</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
<?php

if(isset($_POST['captcha_input'])) {
    $user_answer =$_POST['captcha_input'];
    if($user_answer== "200"){
            echo "formulaire soumis avec succès"; 
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $gender = $_POST['gender'];

            $passHash = password_hash($pass, PASSWORD_BCRYPT);

            $insertUser = "
            INSERT INTO users (firstname, lastname, email, password, gender)
            VALUES (:firstname, :lastname, :email, :password, :gender)
            ";

            $preparedQuery = $dbh->prepare($insertUser);
            $preparedQuery->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $passHash,
                'gender' => $gender,
            ]); 
            echo("Votre compte a bien été créé"); header('Location: ../PHP/loginForm.php');
    } else { echo "réponce incorrect. Veuiller Rréessayer" ; }
} else {echo "veuiller répondre au captchat." ; }