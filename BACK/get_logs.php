<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include __DIR__ . '/db.php'; 


if (!isset($dbh)) {
    die("Erreur de connexion : " . var_dump($e));
}

try {
 
    $query = "SELECT action, ip, date, firstname, email FROM logs";
    $stmt = $dbh->query($query);
    
    if (!$stmt) {
        die("Erreur dans la requête SQL : " . var_dump($dbh->errorInfo()));
    }

    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
    echo json_encode($logs);
} catch (PDOException $e) {
    die("Erreur dans la requête SQL : " . $e->getMessage());
}
?>
