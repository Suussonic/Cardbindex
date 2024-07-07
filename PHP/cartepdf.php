<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Inclure la bibliothèque FPDF
require('../fpdf186/fpdf.php');

// Récupérer toutes les informations des cartes
$sql = "SELECT id, card_name, card_description, card_value FROM cards"; // Assurez-vous que cette requête correspond à vos données

try {
    $stmt = $dbh->query($sql);
    $cards = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}

// Générer le PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Card Information', 0, 1, 'C');
        $this->Ln(10);
    }

    function CardTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(10, 50, 90, 30);
        // En-têtes
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        // Données
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id'], 1);
            $this->Cell($w[1], 6, $row['card_name'], 1);
            $this->Cell($w[2], 6, $row['card_description'], 1);
            $this->Cell($w[3], 6, $row['card_value'], 1);
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('ID', 'Card Name', 'Description', 'Value');

$pdf->CardTable($header, $cards);
$pdf->Output('D', 'card_data.pdf');
exit;
?>
