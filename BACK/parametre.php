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

                <div class="dropdown">
                    <span>Administration</span>
                    <div class="dropdown-content">
                        <a href="#page3">- Liste utilisateur</a><br>
                        <a href="#page4">- Captcha</a><br>
                        <a href="#page5">- Logs</a><br>
                        <a href="#page6">- Newsletter</a><br>
                    </div>
                </div>
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
                            <th>firstname</th>
                            <th>lastname</th>
                            <th>Email</th>
                            <th>gender</th>
                            <th>Role</th>
                            <th>Admin</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>man</td>
                            <td>user</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>man</td>
                            <td>admin</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>man</td>
                            <td>user</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test@example.com</td>
                            <td>man</td>
                            <td>admin</td>
                            <td>
                                <button class="button" onclick="alert('Éditer utilisateur')">Éditer</button>
                                <button class="button" onclick="alert('Supprimer utilisateur')">Supprimer</button>
                            </td>
                        </tr>
                        <!-- Ajoutez d'autres lignes pour plus d'utilisateurs -->
                    </table>
                </div>
            </div>
            <div id="page4" class="page">
                <h1>Captcha</h1>
            </div>
            <div id="page5" class="page">
                <h1>Logs</h1>
            </div>
            <div id="page6" class="page">
                <h1>Création Newsletter</h1>
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
