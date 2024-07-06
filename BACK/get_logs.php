<?php
// Connexion à la base de données
include '../PHP/db.php';

$query = "SELECT action, DATE_FORMAT(date, '%Y-%m-%d') as date FROM logs"; // Extrait la date sans l'heure
$result = mysqli_query($conn, $query);
$logs = array();

while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
}

echo json_encode($logs);
?>