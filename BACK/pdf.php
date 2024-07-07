<?php
// Inclure la bibliothèque FPDF
require('../fpdf186/fpdf.php');

// Générer le PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'User Information', 0, 1, 'C');
        $this->Ln(10);
    }

    function UserTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(10, 30, 30, 50, 20, 30);
        // En-têtes
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        // Données
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 1);
            $this->Cell($w[1], 6, $row[1], 1);
            $this->Cell($w[2], 6, $row[2], 1);
            $this->Cell($w[3], 6, $row[3], 1);
            $this->Cell($w[4], 6, $row[4], 1);
            $this->Cell($w[5], 6, $row[5], 1);
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('ID', 'Firstname', 'Lastname', 'Email', 'Gender', 'Role');
$data = [
    [1, 'John', 'Doe', 'john@example.com', 'man', 'admin'],
    [2, 'Jane', 'Smith', 'jane@example.com', 'woman', 'user']
];

$pdf->UserTable($header, $data);
$pdf->Output('D', 'user_data.pdf');
exit;
?>
