<?php
// Connexion à la base de données
include 'db.php';

// Exécuter la requête pour obtenir les logs
$query = "SELECT action, ip, date, firstname, email FROM logs";
$result = mysqli_query($conn, $query);

$logs = array();
while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
}

// Renvoyer les logs en format JSON
echo json_encode($logs);
?>