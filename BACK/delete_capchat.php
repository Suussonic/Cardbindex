<?php
include 'db.php'; // Include the database connection file

// Check if the delete_id is set in the POST request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([':id' => $delete_id]);

    // Redirect back to the main page
    header("Location: display_captcha.php");
    exit;
} else {
    // If no delete_id is set, redirect back to the main page
    header("Location: display_captcha.php");
    exit;
}
?>
