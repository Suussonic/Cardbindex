<?php
session_start();
// Inclure le fichier de connexion à la base de données
include_once('db.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Web</title>
    <link rel="stylesheet" href="../CSS/parametre.css">
    <?php include '../PHP/theme.php'; ?>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="../index.php"><img src="../ASSET/CARDBINDEX V4.png" alt="LOGO"></a></li>
                <li><a href="#page1">Informations du compte</a></li>
                <li><a href="#page2">Conditions d'utilisateurs</a></li>       
                
                <div class="dropdown">
                    <span>Administration</span>
                    <div class="dropdown-content">
                        <a href="#page3">- Liste utilisateur</a><br>
                        <a href="#page4">- Captcha</a><br>
                        <a href="#page5">- Logs</a><br>
                        <a href="#page6">- Pdf</a><br>
                    </div>
                </div>
            </ul>
        </div>


        <div class="content">
            <div id="page1" class="page">
            <?php include '../PHP/compte.php'; ?>
            </div>
            <div id="page2" class="page">
                <h1>Conditions Générales d'Utilisation</h1>
                <div class="Liste des condition">

                    <h2>1. Acceptation des Conditions</h2>
                    <p>En accédant à ce site web et en l'utilisant, vous acceptez de vous conformer aux présentes conditions d'utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser ce site.</p>

                    <h2>2. Modifications des Conditions</h2>
                    <p>Nous nous réservons le droit de modifier ces conditions à tout moment. Les modifications entreront en vigueur dès leur publication sur ce site. Il vous incombe de consulter régulièrement ces conditions pour prendre connaissance des changements éventuels.</p>

                    <h2>3. Utilisation du Site</h2>
                    <p>Vous vous engagez à utiliser ce site uniquement à des fins légales et de manière conforme aux présentes conditions. Vous ne devez pas utiliser ce site de manière qui pourrait causer des dommages au site ou nuire à l'utilisation et à la jouissance du site par d'autres utilisateurs.</p>

                    <h2>4. Propriété Intellectuelle</h2>
                    <p>Tout le contenu de ce site, y compris les textes, graphiques, logos, images et logiciels, est la propriété de cardbindex ou de ses concédants de licence et est protégé par les lois sur le droit d'auteur et autres lois sur la propriété intellectuelle. Vous n'êtes pas autorisé à reproduire, distribuer, modifier, afficher, exécuter ou utiliser autrement le contenu de ce site sans notre autorisation écrite préalable.</p>

                    <h2>5. Compte Utilisateur</h2>
                    <p>Pour accéder à certaines fonctionnalités de ce site, vous devrez peut-être créer un compte utilisateur. Vous êtes responsable de la confidentialité de votre compte et de votre mot de passe et de toutes les activités qui se produisent sous votre compte. Vous acceptez de nous informer immédiatement de toute utilisation non autorisée de votre compte.</p>

                    <h2>6. Politique de Confidentialité</h2>
                    <p>Notre politique de confidentialité, disponible à [lien vers la politique de confidentialité], explique comment nous recueillons, utilisons et protégeons vos informations personnelles. En utilisant ce site, vous acceptez les termes de notre politique de confidentialité.</p>

                    <h2>7. Limitation de Responsabilité</h2>
                    <p>Dans les limites permises par la loi, cardbindex ne sera pas responsable des dommages directs, indirects, accessoires, consécutifs ou punitifs résultant de l'utilisation ou de l'incapacité d'utiliser ce site ou son contenu, même si nous avons été informés de la possibilité de tels dommages.</p>

                    <h2>8. Résiliation</h2>
                    <p>Nous nous réservons le droit de résilier ou de suspendre votre accès à ce site, avec ou sans préavis, pour toute conduite que nous jugeons, à notre seule discrétion, violer ces conditions ou être autrement nuisible à notre site ou à nos intérêts.</p>

                    <h2>9. Dispositions Générales</h2>
                    <p>Si une disposition de ces conditions est jugée invalide ou inapplicable, cette disposition sera supprimée ou limitée dans la mesure minimale nécessaire, et les dispositions restantes resteront en vigueur.</p>

                    <p>Pour toute question concernant ces conditions d'utilisation, veuillez nous contacter à .</p>
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
                <?php include '../PHP/graph.php'; ?>
            </div>
            <div id="page6" class="page">
                <h1>Pdf</h1>
                <form action="pdf.php" method="get">
                    <button type="submit">Télécharger PDF</button>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="../JS/easteregg.js"></script>
</body>
</html>
