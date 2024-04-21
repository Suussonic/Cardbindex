<?php
global $dbh;
require_once('db.php');

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
            echo("Votre compte a bien été créé");header('Location:../index.php');
    } else { echo "réponce incorrect. Veuiller Rréessayer" ; }
} else {echo "veuiller répondre au captchat." ; }

