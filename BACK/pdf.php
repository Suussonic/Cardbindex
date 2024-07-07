<?php
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', 'tn3bbjTDe5UQ', 'pdf_generator');

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
        $pdf->Output();
        exit; // Terminer le script après la génération du PDF

    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Generate PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin: 20px; }
        label, input { display: block; margin: 10px 0; }
        button { margin-top: 10px; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Generate PDF</h1>
    <form id="pdfForm" method="GET" action="">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required>
        <button type="submit">Generate PDF</button>
    </form>

    <script>
        document.getElementById('pdfForm').addEventListener('submit', function (e) {
            const userId = document.getElementById('user_id').value;
            window.open(`index.php?user_id=${userId}`, '_blank');
        });
    </script>
</body>
</html>

