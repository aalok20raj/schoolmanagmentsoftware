<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    require("../../Assets/fpdf/fpdf.php");
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }

    $pdf = new FPDF();
    $pdf ->AddPage();
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(0,10,"ID Card",1,1,'C');
    $pdf->output();

?>