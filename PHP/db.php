<?php

$user = 'debian';
$password = 'dsfscx1lkj545';
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=projet', $user, $password, $options);
} catch (PDOException $e) {
    var_dump($e);
}

//$userQuery = $dbh->query("SELECT * FROM users");
//$allUsers = $userQuery->fetchAll();
//var_dump($allUsers);
