<?php
$user = 'root';
$password = 'tn3bbjTDe5UQ';
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=promo4', $user, $password, $options);
} catch (PDOException $e) {
    die("La connexion a échoué : " . $e->getMessage());
}
?>
