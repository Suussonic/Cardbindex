<?php
    if (isset($_SESSION['userId'])) { 
        $userId = $_SESSION['userId'];

        $getUser = "SELECT role FROM users WHERE id = :id";
        
        $preparedGetUser = $dbh->prepare($getUser);
        $preparedGetUser->execute([
            'id' => $userId
        ]);

        $result = $preparedGetUser->fetch(PDO::FETCH_ASSOC);

        if ($result) { 
            if ($result['role'] == 'admin') {
                echo '<div class="dropdown">
                    <span>Administration</span>
                    <div class="dropdown-content">
                        <a href="#page3">- Liste utilisateur</a><br>
                        <a href="#page4">- Captcha</a><br>
                        <a href="#page5">- Logs</a><br>
                        <a href="#page6">- Newsletter</a><br>
                    </div></div>"';
            }
        }
    }
?>