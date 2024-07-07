<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
global $dbh;
require_once('db.php');

if (isset($_POST['captcha_input'])) {
    $user_answer = $_POST['captcha_input'];
    if ($user_answer == "200") {
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
        header("Location: /");
        exit;
    } else {
        echo "réponse incorrecte. Veuillez réessayer";
        header("Location: form.php");
        exit;
    }
} else {
    echo "Veuillez répondre au captcha.";
}

?>