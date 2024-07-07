<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../../PHP/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cardId'])) {
        $cardId = $_POST['cardId'];

        // Récupération des informations de l'utilisateur
        $getUser = "SELECT firstname FROM users WHERE id = :id";
        $preparedGetUser = $dbh->prepare($getUser);
        $preparedGetUser->execute([
            'id' => $_SESSION['userId']
        ]);

        $user = $preparedGetUser->fetch();

        if ($user) {
            $firstname = $user['firstname'];

            // Insertion dans la base de données
            $insertUser = "
            INSERT INTO classeur (firstname, id_carte)
            VALUES (:firstname, :cardId)
            ";

            $preparedQuery = $dbh->prepare($insertUser);
            $success = $preparedQuery->execute([
                'firstname' => $firstname,
                'cardId' => $cardId,
            ]);

            if ($success) {
                echo "ID de la carte stocké avec succès pour $firstname!";
            } else {
                echo "Erreur lors de l'insertion de l'ID de la carte.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    } else {
        echo "Aucun ID de carte reçu.";
    }
} else {
    echo "Méthode de requête non valide.";
}
?>
