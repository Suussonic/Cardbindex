<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Web</title>
    <link rel="stylesheet" href="../CSS/parametre.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="#page1">Informations du compte</a></li>
                <li><a href="#page2">Profil utilisateur</a></li>
                <li><a href="#page3">Administration</a></li>
            </ul>
        </div>
        <div class="content">
            <div id="page1" class="page">
                <h1>Informations du compte</h1>
                <div class="profile-section">
                    <img id="profile-img" src="default-profile.png" alt="Profile Image">
                    <form id="profile-form">
                        <label for="profile-name">Nom :</label>
                        <input type="text" id="profile-name" name="profile-name" value="Utilisateur">
                        <br><br>
                        <label for="profile-gender">Genre :</label>
                        <select id="profile-gender" name="profile-gender">
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                            <option value="autre">Autre</option>
                        </select>
                        <br><br>
                        <label for="profile-img-upload">Changer l'image de profil :</label>
                        <input type="file" id="profile-img-upload" name="profile-img-upload">
                        <br><br>
                        <button type="submit" class="button">Mettre à jour</button>
                    </form>
                </div>
            </div>
            <div id="page2" class="page">
                <h1>Profil utilisateur</h1>
                <div class="user-profile">
                    <p><strong>Nom :</strong> <span id="display-name">Utilisateur</span></p>
                    <img id="display-img" src="default-profile.png" alt="Profile Image">
                    <p><strong>Genre :</strong> <span id="display-gender">Homme</span></p>
                    <p><strong>Email :</strong> utilisateur@example.com</p>
                    <p><strong>Date de naissance :</strong> 01/01/1970</p>
                </div>
            </div>
            <div id="page3" class="page">
                <h1>Administration</h1>
                <div class="admin-section">
                    <table class="admin-table">
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>Pseudo</th>
                            <th>ip</th>
                            <th>date</th>
                            <th>firstname</th>
                            <th>Email</th>
                            <th>Admin</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Connection</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>35</td>
                            <th>modification</th>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <th>modification</th>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>connection</th>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
