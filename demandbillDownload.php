<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'conventsschool';
$conn = mysqli_connect($server,$username,$password,$db);

$bill_id = mysqli_real_escape_string($conn,$_GET['id']);
$selectdemandbilldata = mysqli_query($conn, "SELECT * FROM demandbilllist WHERE db_id ='$bill_id'");
$DisplayDemandbill = mysqli_fetch_assoc($selectdemandbilldata);
$student_status = 1;
$selectStuData = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_status ='$student_status'");



require('../../Assets/fpdf/fpdf.php');
// A4 width : 219 mm;
// default margian : 10mm each side;
// writable horizontal : 219-(10*2) = 189 mm;


$pdf = new FPDF('p','mm', 'A4');
$pdf -> AddPage();
while($arraystudent = mysqli_fetch_array($selectStuData)){
$stud_ids = $arraystudent['sl_id'];
$stuclassstatus = 1;
$stuselectclass = mysqli_query($conn, "SELECT * FROM studentclasslist WHERE SCL_status ='$stuclassstatus' and SCL_stuID = '$stud_ids'");
$displaystuclass = mysqli_fetch_assoc($stuselectclass);

$classid = $displaystuclass['SCL_class'];
$selectclass = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_id = '$classid'");
$displayclass = mysqli_fetch_assoc($selectclass);

$selectclassfee = mysqli_query($conn, "SELECT * FROM feelistclass WHERE FL_class='$classid'");
$displayclassfee = mysqli_fetch_assoc($selectclassfee);
if($displayclassfee['FL_service_name']='Fee'){
	$monthy = $displayclassfee['FL_Fee'];
}
if($displayclassfee['FL_service_name']='Transport'){
	$Transport = $displayclassfee['FL_Fee'];
}
// set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,6,'STUDENTS SUCCESS CONVENT',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,6,'Sarbahda Road, Sarbahda, Gaya, 823311',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,'Demand Bill of '.date("M-Y", strtotime($DisplayDemandbill['db_month'])),0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,'Reg. No.',1,0,'L');
$pdf->Cell(55,6,$arraystudent['sl_regi'],1,0,'L');
$pdf->Cell(15,6,'Session',1,0,'L');
$pdf->Cell(30,6,$displaystuclass['SCL_session'],1,0,'L');
$pdf->Cell(25,6,'Bill Date',1,0,'L');
$pdf->Cell(45,6,date("D d-M-Y", strtotime($DisplayDemandbill['db_date'])),1,1,'L');
$pdf->Cell(16,6,'Name',1,0,'L');
$pdf->Cell(80,6,$arraystudent['sl_name'],1,0,'L');
$pdf->Cell(16,6,'Class',1,0,'L');
$pdf->Cell(15,6,$displayclass['cl_name'],1,0,'C');
$pdf->Cell(16,6,'Roll No.',1,0,'L');
$pdf->Cell(15,6,$displaystuclass['SCL_rollno'],1,0,'C');
$pdf->Cell(16,6,'Section',1,0,'C');
$pdf->Cell(16,6,'',1,1,'L');
$pdf->Cell(25,6,'Monthly Fee',1,0,'L');
$pdf->Cell(70,6,$monthy,1,0,'L');
$pdf->Cell(25,6,'Previous Dues',1,0,'L');
$pdf->Cell(45,6,'',1,0,'L');
$pdf->Cell(25,6,'',1,1,'L');
$pdf->Cell(25,6,'Other Fee',1,0,'L');
$pdf->Cell(140,6,$Transport,1,0,'L');
$pdf->Cell(25,6,'',1,1,'L');
$pdf->Cell(140,6,$DisplayDemandbill['db_message'],1,0,'L');
$pdf->Cell(25,6,'Total Amount',1,0,'L');
$pdf->Cell(25,6,'',1,1,'L');
$pdf->Cell(0,5,'----------------------------------------------------------------------------------------------------------------------------------------------------------',0,1,'C');

}
$pdf->Output();
?>