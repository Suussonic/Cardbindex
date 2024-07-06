<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de connexion à la base de données
require_once('db.php');

// Inclure le fichier de vérification du mot de passe
include('../BACK/verifmdp.php');

// Vérifier si le captcha a été soumis
if (isset($_POST['captcha_input'])) {
    $user_answer = $_POST['captcha_input'];
    
    // Vérifier la réponse du captcha
    if ($user_answer == "200") {
        // Récupérer les données du formulaire
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $gender = $_POST['gender'];
        
        // Vérifier le mot de passe
        if (verifierMotDePasse($pass)) {
            // Hacher le mot de passe
            $passHash = password_hash($pass, PASSWORD_BCRYPT);
            
            // Préparer la requête SQL
            $insertUser = "
            INSERT INTO users (firstname, lastname, email, password, gender)
            VALUES (:firstname, :lastname, :email, :password, :gender)
            ";
            
            // Préparer et exécuter la requête
            $preparedQuery = $dbh->prepare($insertUser);
            if ($preparedQuery->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $passHash,
                'gender' => $gender,
            ])) {
                // Rediriger en cas de succès
                header("Location: /");
                exit;
            } else {
                echo "Erreur lors de la création du compte : " . implode(", ", $preparedQuery->errorInfo());
            }
        } else {
            header('Location: form.php?error=Votre mot de passe doit posséder un minimum de 8 caractères, dont une majuscule, une minuscule, un caractère spécial et un chiffre.');
            exit;
        }
    } else {
        echo "Réponse incorrecte. Veuillez réessayer";
        header("Location: form.php");
        exit;
    }
} else {
    echo "Veuillez répondre au captcha.";
}
?>
