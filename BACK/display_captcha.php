<?php
include '../BACK/db.php';

$sql = "SELECT id, q, r FROM captcha";
$result = $conn->query($sql);
?>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Q</th>
        <th>R</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["q"] . "</td><td>" . $row["r"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>0 résultats</td></tr>";
    }
    $conn->close();
    ?>
</table>
