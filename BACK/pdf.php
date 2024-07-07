<?php
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    session_start();
    include_once('./PHP/db.php');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

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

            function UserDetails($user)
            {
                $this->SetFont('Arial', '', 12);
                foreach ($user as $key => $value) {
                    $this->Cell(30, 10, ucfirst($key) . ':', 0, 0);
                    $this->Cell(50, 10, $value, 0, 1);
                }
            }
        }

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->UserDetails($user);
        $pdf->Output('D', 'user_info.pdf'); // 'D' forces the PDF to download
        exit; // Terminer le script après la génération du PDF

    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "User ID not provided.";
}
?>
