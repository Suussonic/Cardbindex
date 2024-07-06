<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de connexion à la base de données
include 'db.php';

// Vérifier la connexion à la base de données
if (!$dbh) {
    die("Erreur de connexion : " . var_dump($e));
}

try {
    // Exécuter la requête pour obtenir les logs
    $query = "SELECT action, ip, date, firstname, email FROM logs";
    $stmt = $dbh->query($query);
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Renvoyer les logs en format JSON
    echo json_encode($logs);
} catch (PDOException $e) {
    die("Erreur dans la requête SQL : " . $e->getMessage());
}
?>
