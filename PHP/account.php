<?php
global $dbh;
session_start();
include_once('db.php');

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $editUserSql = '
        UPDATE users
        SET firstname = :firstname,
            lastname = :lastname,
            email = :email,
            gender = :gender
        WHERE id = :id
    ';

    $preparedEditUser = $dbh->prepare($editUserSql);
    $preparedEditUser->execute([
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'gender' => $_POST['gender'],
        'id' => $_SESSION['userId']
    ]);
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
}


$getUser = "SELECT id, firstname, lastname, email, gender FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
        'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

    <h1>Bienvenue <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></h1>

    <form action="" method="POST">

        <div>
            <label for="firstname">Prenom</label>
            <input
                    id="firstname"
                    type="text"
                    name="firstname"
                    placeholder="Prenom"
                    value="<?php echo $user['firstname'] ?>"
            >
        </div>
        <!--  NOM  -->
        <div>
            <label for="lastname">Nom</label>
            <input id="lastname" type="text" name="lastname" value="<?php echo $user['lastname'] ?>">
        </div>
        <!--  EMAIL  -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?php echo $user['email'] ?>">
        </div>
        <!--  GENRE (RADIO button)  -->
        <div>
            <label for="man">Homme</label>
            <input
                    id="man"
                    type="radio"
                    name="gender"
                    value="man"
                <?php echo $user['gender'] === "man" ? 'checked' : '' ?>
            >

            <label for="woman">Femme</label>
            <input
                    id="woman"
                    type="radio"
                    name="gender"
                    value="woman"
                <?php echo $user['gender'] === "woman" ? 'checked' : '' ?>
            >

            <label for="other">Autre</label>
            <input
                    id="other"
                    type="radio"
                    name="gender"
                    value="other"
                <?php echo $user['gender'] === "other" ? 'checked' : '' ?>
            >
        </div>

        <input type="submit" value="Modifier">

    </form>
</body>
</html>