<?php
$user = 'abdou';
$password = 'tn3bbjTDe5UQ';

try {
    $dbh = new PDO('mysql:host:localhost;dbname=projet', $user, $password);
} catch (PDOException $e) {
    var_dump($e);
}

//$userQuery = $dbh->query("SELECT * FROM users");
//$allUsers = $userQuery->fetchAll();
//var_dump($allUsers);
