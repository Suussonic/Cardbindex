<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inclure la bibliothèque FPDF
require('../fpdf186/fpdf.php');

// Récupérer toutes les informations des utilisateurs
$sql = "SELECT id, firstname, lastname, email, gender, role FROM users";
$result = $conn->query($sql);

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
            $this->Cell($w[0], 6, $row['id'], 1);
            $this->Cell($w[1], 6, $row['firstname'], 1);
            $this->Cell($w[2], 6, $row['lastname'], 1);
            $this->Cell($w[3], 6, $row['email'], 1);
            $this->Cell($w[4], 6, $row['gender'], 1);
            $this->Cell($w[5], 6, $row['role'], 1);
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('ID', 'Firstname', 'Lastname', 'Email', 'Gender', 'Role');
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$pdf->UserTable($header, $data);
$pdf->Output('D', 'user_data.pdf');
exit;
?>
