<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'conventsschool';
$conn = mysqli_connect($server,$username,$password,$db);

$selectStudent  = mysqli_query($conn, "SELECT * FROM studentlist ");
require('../../Assets/fpdf/fpdf.php');
// A4 width : 219 mm;
// default margian : 10mm each side;
// writable horizontal : 219-(10*2) = 189 mm;

$pdf = new FPDF('p','mm', 'A4');
$pdf -> AddPage();
// set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//$pdf->Image('../../Assets/Images/STUDENTS SUCCESS CONVENT LOGO Social Media Logo.jpg',10,10,50);


//Cell(width, height, text, border, end line, [align]);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(8, 91, 207);
$pdf->Cell(0,6,'STUDENTS SUCCESS CONVENT',0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,4,'Sarbahda Bazar,Dih Road, Sarbahda, Gaya, Bihar',0,1,'C');
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(207, 21, 8);
$pdf->Cell(0,10,'Registration Slip',0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(15,6,'Bill No.',1,0,'L');
$pdf->Cell(25,6,'',1,0,'L');
$pdf->Cell(25,6,'Issue Date',1,0,'L');
$pdf->Cell(25,6,'',1,0,'L');
$pdf->Cell(20,6,'Month',1,0,'L');
$pdf->Cell(25,6,'',1,0,'L');
$pdf->Cell(23,6,'Reg. No.',1,0,'L');
$pdf->Cell(28,6,'',1,1,'L');
$pdf->Cell(15,6,'Name',1,0,'L');
$pdf->Cell(43,6,'',1,0,'L');
$pdf->Cell(25,6,'Fathers Name',1,0,'L');
$pdf->Cell(43,6,'',1,0,'L');
$pdf->Cell(15,6,'Class',1,0,'L');
$pdf->Cell(15,6,'',1,0,'L');
$pdf->Cell(15,6,'Roll No.',1,0,'L');
$pdf->Cell(15,6,'',1,1,'L');
$pdf->Cell(25,6,'Sr. No.',1,0,'L');
$pdf->Cell(125,6,'Particulars',1,0,'L');
$pdf->Cell(36,6,'Amount',1,0,'L');
$pdf->Output();
?>