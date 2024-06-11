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
        header("Location: /createAccount.php");
        exit;
    }
} else {
    echo "Veuillez répondre au captcha.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include 'theme.php'; ?>
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