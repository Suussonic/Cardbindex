<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
include_once('db.php');

// Inclure la bibliothèque FPDF
require('../fpdf186/fpdf.php');

// Récupérer les cartes de l'utilisateur spécifique
$user_id = $_SESSION['user_id']; // Supposons que l'ID utilisateur soit stocké dans la session
$sql = "SELECT firstname, id_carte FROM classeur WHERE user_id = :user_id";

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
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
        $this->Cell(0, 10, 'Informations des cartes', 0, 1, 'C');
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

    function CardImages($data)
    {
        $this->AddPage();
        foreach ($data as $row) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, $row['firstname'], 0, 1, 'C');
            $this->Ln(10);
            // Supposons que l'image de la carte soit stockée avec un nom de fichier basé sur l'id_carte
            $image_path = '../images/cards/' . $row['id_carte'] . '.png'; // Assurez-vous que ce chemin est correct
            if (file_exists($image_path)) {
                $this->Image($image_path, 10, $this->GetY(), 190);
                $this->Ln(100); // Ajustez la hauteur en fonction de vos images
            } else {
                $this->Cell(0, 10, 'Image non trouvée pour la carte: ' . $row['id_carte'], 0, 1, 'C');
                $this->Ln(10);
            }
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('Prénom', 'ID Carte');

$pdf->CardTable($header, $cards);
$pdf->CardImages($cards);
$pdf->Output('D', 'card_data.pdf');
exit;
?>
