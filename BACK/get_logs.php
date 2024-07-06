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
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

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