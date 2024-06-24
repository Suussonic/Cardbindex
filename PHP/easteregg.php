<?php
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$badge_value = $data['badge_value'];

// Insertion des données dans la base de données
$sql = "INSERT INTO badge (user_id, value) VALUES ('$user_id', '$badge_value')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
