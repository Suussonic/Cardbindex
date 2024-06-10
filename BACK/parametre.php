<?php
global $dbh;
session_start();
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editUserSql = '
        UPDATE users
        SET firstname = :firstname,
            lastname = :lastname,
            email = :email,
            gender = :gender,
            theme = :theme
        WHERE id = :id
    ';

    $preparedEditUser = $dbh->prepare($editUserSql);
    $preparedEditUser->execute([
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'gender' => $_POST['gender'],
        'theme' => $_POST['theme'],
        'id' => $_SESSION['userId']
    ]);
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    if ($_POST['theme'] == 0) {
        $_SESSION['color_theme'] = "white";
    } else {
        $_SESSION['color_theme'] = "#26272C";
    }
}


$getUser = "SELECT * FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
    'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch();
$test = "SELECT id_carte FROM classeur WHERE firstname=:firstname";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Web</title>
    <link rel="stylesheet" href="../CSS/parametre.css">
</head>

<body style="background-color:<?php echo $_SESSION['color_theme']; ?> ">
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="#page1">Informations du compte</a></li>
                <li><a href="#page2">Profil utilisateur</a></li>
                <?php if ($user['role'] == 'admin') { ?>
                    <li><a href="#page3">Administration</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="content">
            <div id="page1" class="page">
                <h1>Informations du compte</h1>
                <div class="profile-section">
                    <img id="profile-img" src="default-profile.png" alt="Profile Image">
                    <form id="profile-form" action="parametre.php" method="POST">
                        <label for="profile-name">Prénom :</label>
                        <input id="firstname" type="text" name="firstname" placeholder="Prénom" value="<?php echo $user['firstname'] ?>">
                        <label for="profile-name">Nom :</label>
                        <input id="firstname" type="text" name="lastname" placeholder="Nom" value="<?php echo $user['lastname'] ?>">
                        <br><br>
                        <label for="profile-gender">Genre :</label>
                        <select id="profile-gender" name="profile-gender">
                            <?php if($user['gender'] == 'man'){ ?>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                                <option value="autre">Autre</option>
                            <?php }elseif ($user['gender'] == 'woman'){ ?>
                                <option value="femme">Femme</option>
                                <option value="homme">Homme</option>
                                <option value="autre">Autre</option>
                            <?php }else{ ?>
                                <option value="autre">Autre</option>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                            <?php } ?>
                        </select>
                        <br><br>
                        <label for="profile-img-upload">Changer l'image de profil :</label>
                        <input type="file" id="profile-img-upload" name="profile-img-upload">
                        <br><br>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </div>
            </div>
            <div id="page2" class="page">
                <h1>Profil utilisateur</h1>
                <div class="user-profile">
                    <p><strong>Prénom :</strong> <span id="display-name"><?php echo $user['firstname'] ?></span></p>
                    <p><strong>Nom :</strong> <span id="display-name"><?php echo $user['lastname'] ?></span></p>
                    <img id="display-img" src="default-profile.png" alt="Profile Image">
                    <p><strong>Genre :</strong> <span id="display-gender"><?php echo $user['gender'] ?></span></p>
                    <p><strong>Email :</strong> <?php echo $user['email'] ?></p>
                    <p><strong>Date de naissance :</strong> 01/01/1970</p>
                </div>
            </div>
            <div id="page3" class="page">
                <h1>Administration</h1>
                <div class="admin-section">
                    <h2>Gestion des utilisateurs</h2>
                    <button onclick="alert('Ajouter un utilisateur')">Ajouter un utilisateur</button>
                    <button onclick="alert('Supprimer un utilisateur')">Supprimer un utilisateur</button>
                    <button onclick="alert('Modifier un utilisateur')">Modifier un utilisateur</button>
                    <br><br>
                    <h2>Gestion des contenus</h2>
                    <button onclick="alert('Ajouter du contenu')">Ajouter du contenu</button>
                    <button onclick="alert('Supprimer du contenu')">Supprimer du contenu</button>
                    <button onclick="alert('Modifier du contenu')">Modifier du contenu</button>
                    <br><br>
                    <h2>Paramètres du site</h2>
                    <button onclick="alert('Modifier les paramètres du site')">Modifier les paramètres du site</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pages = document.querySelectorAll('.page');
            const links = document.querySelectorAll('.sidebar a');
            const profileForm = document.getElementById('profile-form');
            const profileImg = document.getElementById('profile-img');
            const displayImg = document.getElementById('display-img');
            const profileName = document.getElementById('profile-name');
            const profileGender = document.getElementById('profile-gender');
            const displayName = document.getElementById('display-name');
            const displayGender = document.getElementById('display-gender');

            function showPage(id) {
                pages.forEach(page => {
                    page.style.display = page.id === id ? 'block' : 'none';
                });
            }

            links.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const id = link.getAttribute('href').substring(1);
                    showPage(id);
                });
            });

            profileForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = profileName.value;
                const gender = profileGender.value;
                const imgUpload = document.getElementById('profile-img-upload').files[0];

                if (imgUpload) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImg.src = e.target.result;
                        displayImg.src = e.target.result;
                    }
                    reader.readAsDataURL(imgUpload);
                }

                displayName.textContent = name;
                displayGender.textContent = gender.charAt(0).toUpperCase() + gender.slice(1);
                alert('Profil mis à jour : ' + name);
            });

            // Affiche par défaut la première page
            showPage('page1');
        });
    </script>
</body>

</html>