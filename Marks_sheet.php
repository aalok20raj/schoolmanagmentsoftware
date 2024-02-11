<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'conventsschool';
$conn = mysqli_connect($server,$username,$password,$db);

$id = mysqli_real_escape_string($conn,$_GET['id']);
$selectResult = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_id ='$id'");
$DisplayResult = mysqli_fetch_assoc($selectResult);


$selectStuData = mysqli_query($conn, "SELECT * FROM studentlist");
require('../../Assets/fpdf/fpdf.php');
// A4 width : 219 mm;
// default margian : 10mm each side;
// writable horizontal : 219-(10*2) = 189 mm;


$pdf = new FPDF('l','mm', 'A4');
$pdf -> AddPage();
// set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width, height, text, border, end line, [align]);
$pdf->SetFont('Arial','B',25);
$pdf->SetTextColor(8, 91, 207);
$pdf->Cell(0,10,'STUDENTS SUCCESS CONVENT',0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,4,'Sarbahda Bazar,Dih Road, Sarbahda, Gaya, Bihar',0,1,'C');
$pdf->SetFont('Arial','B',15);
$pdf->SetTextColor(207, 21, 8);
$pdf->Cell(0,11,'Mark Entry Sheet',0,1,'C');
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(516, 90, 28);
$pdf->Cell(0,10,$DisplayResult['ex_name'],0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,8,'R. No.',1,0,'L');
$pdf->Cell(50,8,'Students',1,0,'L');
$pdf->Cell(13,8,'Class',1,0,'C');
$pdf->Cell(13,8,'R.n',1,0,'C');
$pdf->Cell(13,8,'Math',1,0,'C');
$pdf->Cell(13,8,'Hin.',1,0,'C');
$pdf->Cell(13,8,'Eng.',1,0,'C');
$pdf->Cell(13,8,'Sci.',1,0,'C');
$pdf->Cell(13,8,'SST',1,0,'C');
$pdf->Cell(13,8,'Com.',1,0,'C');
$pdf->Cell(13,8,'GK',1,0,'C');
$pdf->Cell(13,8,'San.',1,0,'C');
$pdf->Cell(13,8,'H/E',1,0,'C');
$pdf->Cell(13,8,'TP',1,0,'C');
$pdf->Cell(13,8,'Mus.',1,0,'C');
$pdf->Cell(13,8,'Beh.',1,0,'C');
$pdf->Cell(13,8,'Total',1,1,'C');
$pdf->SetFont('Arial','',12);
while($DisplayStuData = mysqli_fetch_assoc($selectStuData)){
	$pdf->Cell(30,8,$DisplayStuData['sl_regi'],1,0,'L');
	$pdf->Cell(50,8,$DisplayStuData['sl_name'],1,0,'L');
	$pdf->Cell(13,8,'Class',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,0,'C');
	$pdf->Cell(13,8,'',1,1,'C');
}
$pdf->Output();
?>