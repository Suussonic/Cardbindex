<?php
session_start();
include_once('db.php');

if (isset($_SESSION['firstname'])) {
    // Si l'utilisateur est connecté
    $userId = $_SESSION['user_id']; // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

    // Préparez une requête pour vérifier la valeur du captcha
    $stmt = $pdo->prepare('SELECT captcha FROM users WHERE id = :id');
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    if ($user && $user['captcha'] == 1) {
        echo '<link rel="stylesheet" href="../CSS/white.css">';
    } else {
        echo '<link rel="stylesheet" href="../CSS/black.css">';
    }
} else {
    // Si l'utilisateur n'est pas connecté
    echo '<link rel="stylesheet" href="../CSS/black.css">';
}
?>