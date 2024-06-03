<?php
global $dbh;
session_start();
include_once('db.php');

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $editUserSql = '
        UPDATE users
        SET email = :email,
        WHERE pseudo = :pseudo
    ';

    $preparedEditUser = $dbh->prepare($editUserSql);
    $preparedEditUser->execute([
        'email' => $_POST['email'],
        'pseudo' => $_SESSION['pseudo']
    ]);
}


$getUser = "SELECT pseudo, email FROM users WHERE pseudo = :pseudo";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
        'pseudo' => $_SESSION['pseudo']
]);

$user = $preparedGetUser->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include 'theme.php'; ?>
    <title>Mon compte</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="form.php">Créer compte</a></li>
                <li><a href="loginForm.php">Login</a></li>
                <li><a href="account.php">Mon compte</a></li>
                <li><a href="logout.php">Se deconnecter</a></li>
            </ul>

        </nav>
    </header>

    <h1>Bienvenue <?php echo $_SESSION['pseudo']?></h1>

    <form action="" method="POST">

        <!--  EMAIL  -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?php echo $user['email'] ?>">
        </div>
        </div>

        <input type="submit" value="Modifier">

    </form>
</body>
</html>
