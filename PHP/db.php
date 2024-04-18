<?php
$user = 'abdou';
$password = 'tn3bbjTDe5UQ';

try {
    $dbh = new PDO('mysql:host:54.37.68.230;dbname=projet', $user, $password);
} catch (PDOException $e) {
    var_dump($e);
}

//$userQuery = $dbh->query("SELECT * FROM users");
//$allUsers = $userQuery->fetchAll();
//var_dump($allUsers);
