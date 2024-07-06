<?php
$user = 'root';
$password = 'tn3bbjTDe5UQ';
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=promo4', $user, $password, $options);
} catch (PDOException $e) {
    var_dump($e);
}
?>
