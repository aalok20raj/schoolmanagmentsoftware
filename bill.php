<?php 
require('Assets/fpdf/fpdf.php');
$pdf = new FPDF(); 
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'Hello World!');
    $pdf->Output('my_file.pdf','I'); 
?>