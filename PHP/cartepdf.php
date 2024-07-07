<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Inclure la bibliothèque FPDF
require('../fpdf186/fpdf.php');

// Récupérer toutes les informations des cartes
$sql = "SELECT firstname, id_carte FROM classeur"; // Remplacez "your_table_name" par le nom réel de votre table

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
        $w = array(50, 50);
        // En-têtes
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        // Données
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['firstname'], 1);
            $this->Cell($w[1], 6, $row['id_carte'], 1);
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('Firstname', 'ID Carte');

$pdf->CardTable($header, $cards);
$pdf->Output('D', 'card_data.pdf');
exit;
?>
