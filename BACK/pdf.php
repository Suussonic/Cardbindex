<?php
session_start();
include_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Générer le PDF
    require('../fpdf186/fpdf.php');

    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'User Information', 0, 1, 'C');
            $this->Ln(10);
        }

        function UserDetails($users)
        {
            $this->SetFont('Arial', '', 12);
            foreach ($users as $user) {
                foreach ($user as $key => $value) {
                    $this->Cell(30, 10, ucfirst($key) . ':', 0, 0);
                    $this->Cell(50, 10, $value, 0, 1);
                }
                $this->Ln(10); // Add a line break between users
            }
        }
    }

    $users = $result->fetch_all(MYSQLI_ASSOC);
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->UserDetails($users);
    $pdf->Output('D', 'users_info.pdf'); // 'D' forces the PDF to download
    exit; // Terminer le script après la génération du PDF

} else {
    echo "No users found";
}

$conn->close();
?>
