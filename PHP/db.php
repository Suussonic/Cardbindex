<?php
$user = 'root';
$password = '';

try {
    $dbh = new PDO('mysql:host:localhost;dbname=promo4', $user, $password);
} catch (PDOException $e) {
    var_dump($e);
}

//$userQuery = $dbh->query("SELECT * FROM users");
//$allUsers = $userQuery->fetchAll();
//var_dump($allUsers);
