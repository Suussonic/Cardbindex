<?php
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendMail($sender, $email, $object, $body) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    
    $mail->Username = 'noreplycardbindex@gmail.com';
    $mail->Password = 'vtlwswtcphagplaw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($sender . '@gmail.com');

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = $object;
    $mail->Body = $body;

    $mail->send();

}

$body = '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Newsletter</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .header {
                    text-align: center;
                    padding: 10px 0;
                }
                .header img {
                    max-width: 100%;
                    height: auto;
                }
                .content {
                    padding: 20px;
                    text-align: left;
                }
                .content h1 {
                    color: #333333;
                }
                .content p {
                    color: #555555;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    margin: 20px 0;
                    font-size: 16px;
                    color: #ffffff;
                    background-color: #007bff;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .footer {
                    text-align: center;
                    padding: 10px;
                    font-size: 12px;
                    color: #777777;
                }
                .footer a {
                    color: #007bff;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="../ASSET/CARDBINDEX V5.png" alt="Logo de la newsletter">
                </div>
                <div class="content">
                    <p>Bonjour,</p>
                    <p>Nous sommes ravis de vous compter parmi nos abonnés. Nous avons récemment ajouter une nouvelle série :</p>
                    <img src="../ASSET/img_newsletter.jpg" alt="Image promotionnelle">
                    <p>Pour voir les cartes appuyées sur ce bouton :</p>
                    <a href="https://cardbindex.eu/collection/scarlet_violet.html" class="button">En savoir plus</a>
                    <p>Nous espérons que vous apprécierez cette nouvelle série !</p>
                    <p>Cordialement,<br>L\'équipe de CardBinDex</p>
                </div>
                <div class="footer">
                    <p>Vous recevez cet e-mail parce que vous vous êtes inscrit sur notre site.</p>
                    <p>CardBinDex</p>
                </div>
            </div>
        </body>
        </html>';

$recupEmails = $bdd->query('SELECT email FROM USERS');

while($user = $recupEmails->fetch()) {
    $email = $user['email'];
    $sender = 'noreplycardbindex';
    $objet = 'Votre newsletter de CardBinDex';


    $result = sendMail($sender, $email, $objet, $body);
}
?>