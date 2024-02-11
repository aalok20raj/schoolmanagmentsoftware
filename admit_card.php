<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'conventsschool';
$conn = mysqli_connect($server,$username,$password,$db);

$id = mysqli_real_escape_string($conn,$_GET['id']);
$selectAdmit = mysqli_query($conn, "SELECT * FROM admitcardlist WHERE acl_id ='$id'");
$Displayadmit = mysqli_fetch_assoc($selectAdmit);

$admitId = $Displayadmit['acl_examType'];
$SelectExam = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_id ='$admitId'");
$DisplayExam = mysqli_fetch_assoc($SelectExam);

$selectStuData = mysqli_query($conn, "SELECT * FROM studentlist");
require('../../Assets/fpdf/fpdf.php');
// A4 width : 219 mm;
// default margian : 10mm each side;
// writable horizontal : 219-(10*2) = 189 mm;


$pdf = new FPDF('p','mm', 'A4');
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
$pdf->Cell(0,11,'Admit Card',0,1,'C');
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(516, 90, 28);
$pdf->Cell(0,15,$DisplayExam['ex_name'],0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,8,'R. No.',1,0,'L');
$pdf->Cell(50,8,'',1,0,'L');
$pdf->Cell(20,8,'Session',1,0,'L');
$pdf->Cell(50,8,'',1,0,'L');
$pdf->Cell(50,40,'',1,0);
$pdf->Cell(0,8,'',0,1);
$pdf->Cell(40,8,'Students Name',1,0,'L');
$pdf->Cell(100,8,'',1,1,'L');
$pdf->Cell(40,8,'Fathers Name',1,0,'L');
$pdf->Cell(100,8,'',1,1,'L');
$pdf->Cell(40,8,'Mothers Name',1,0,'L');
$pdf->Cell(100,8,'',1,1,'L');
$pdf->Cell(30,8,'Class',1,0,'L');
$pdf->Cell(40,8,'',1,0,'L');
$pdf->Cell(30,8,'Roll No.',1,0,'L');
$pdf->Cell(40,8,'',1,1,'L');
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Examination DateSheet',1,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,8,'Day',1,0,'L');
$pdf->Cell(30,8,'Exam. Date',1,0,'L');
$pdf->Cell(30,8,'Subject',1,0,'L');
$pdf->Cell(40,8,'1st Setting Timing',1,0,'L');
$pdf->Cell(30,8,'Subject',1,0,'L');
$pdf->Cell(40,8,'2nd Setting Timing',1,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,8,'MON',1,0,'L');
$pdf->Cell(30,8,'03-Apr-2023',1,0,'L');
$pdf->Cell(30,8,'Math',1,0,'L');
$pdf->Cell(40,8,'08:30 AM to 11:30 AM',1,0,'L');
$pdf->Cell(30,8,'Science',1,0,'L');
$pdf->Cell(40,8,'12:00 AM to 03:00 PM',1,1,'L');
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Examination Instructions for Students',1,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,10,'Examination Instructions for Students',1,1,'L');
$pdf->Cell(0,15,'',0,1);
$pdf->Cell(25,10,'Issue Date :',0,0,'L');
$pdf->Cell(50,10,'03-Apr-2023',0,0,'L');
$pdf->Cell(60,10,'Class Teacher Signature',0,0,'L');
$pdf->Cell(50,10,'Principle Singnature & Stamp',0,0,'L');
$pdf->Output();
?>