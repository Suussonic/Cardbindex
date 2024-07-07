<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('db.php');
include('../BACK/verifmdp.php');
session_start();

if (isset($_POST['captcha_input'])) {
    $user_answer = $_POST['captcha_input'];
    $correct_answer = $_SESSION['captcha_answer'];

    if ($user_answer == $correct_answer) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $gender = $_POST['gender'];

        if (verifierMotDePasse($pass)) {
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
            header("Location: /");
            exit;
        } else {
            header('Location: form.php?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            exit;
        }
    } else {
        header('Location: form.php?error=Réponse incorrecte. Veuillez réessayer.');
        exit;
    }
} else {
    header('Location: form.php?error=Veuillez répondre au captcha.');
    exit;
}
?>
