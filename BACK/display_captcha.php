<?php
include 'db.php'; // Include the database connection file

// Define the SQL query to fetch data from the captcha table
$sql = "SELECT id, q, r FROM captcha";
$result = $dbh->query($sql); // Execute the query

if ($result === false) {
    // Handle query error
    die("Error: " . $dbh->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha Display</title>
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table, .admin-table th, .admin-table td {
            border: 1px solid black;
        }
        .admin-table th, .admin-table td {
            padding: 8px;
            text-align: left;
        }
        .admin-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Q</th>
        <th>R</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["id"]) . "</td><td>" . htmlspecialchars($row["q"]) . "</td><td>" . htmlspecialchars($row["r"]) . "</td></tr>";
        }
    } else {
        // If no records are found, display a message
        echo "<tr><td colspan='3'>0 résultats</td></tr>";
    }
    $result->free(); // Free the memory associated with the result
    $dbh->close(); // Close the database connection
    ?>
</table>

</body>
</html>
