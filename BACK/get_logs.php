<?php
include('../PHP/db.php');

$sql = "SELECT * FROM logs";
$result = $conn->query($sql);

$logs = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }
}
echo json_encode($logs);

$conn->close();
?>