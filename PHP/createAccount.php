<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <form method="POST" action="register.php">
        <label for="firstname">Prénom:</label>
        <input type="text" name="firstname" id="firstname" required><br><br>

        <label for="lastname">Nom:</label>
        <input type="text" name="lastname" id="lastname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="gender">Genre:</label>
        <select name="gender" id="gender" required>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
            <option value="other">Autre</option>
        </select><br><br>

        <?php
       
        require_once('db.php');

        
        $sql = "SELECT id, question FROM captcha_questions ORDER BY RAND() LIMIT 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $captcha_id = $row['id'];
            $captcha_question = $row['question'];
        } else {
            echo "Aucune question CAPTCHA trouvée.";
            exit;
        }
        ?>

        <label for="captcha"><?php echo $captcha_question; ?></label>
        <input type="text" name="captcha_answer" id="captcha" required>
        <input type="hidden" name="captcha_id" value="<?php echo $captcha_id; ?>"><br><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
