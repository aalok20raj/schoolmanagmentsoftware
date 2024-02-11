<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'conventsschool';
$conn = mysqli_connect($server,$username,$password,$db);

//Data Fetch query  
$entry_id = mysqli_real_escape_string($conn,$_GET['id']);

$selectStuData = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_id ='$entry_id' AND sl_status ='1'");
$DisplayStuData = mysqli_fetch_assoc($selectStuData);
$photo = $DisplayStuData['sl_photo'];

$sid = $DisplayStuData['sl_id'];
$selectstuclass = mysqli_query($conn, "SELECT * FROM studentclasslist WHERE SCL_status='1' AND SCL_stuID ='$sid' ORDER BY SCL_id");
$displaystuclass = mysqli_fetch_assoc($selectstuclass);

$class = $displaystuclass['SCL_class'];
$selectclass = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_id ='$class'");
$displayclass = mysqli_fetch_assoc($selectclass);

$examname = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_status = '1'");
$displayexamname = mysqli_fetch_assoc($examname);
$examid = $displayexamname['ex_id'];

$examtimetable = mysqli_query($conn, "SELECT * FROM admitcardlist WHERE aci_status='1' AND acl_Class='$class' AND acl_examType='$examid'");


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
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,20,$displayexamname['ex_name'],0,1,'C');
$pdf->SetTextColor(207, 21, 8);
$pdf->Cell(0,8,'ADMIT CARD',0,1,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(45,12,'Admission R. Number',1,0,'L');
$pdf->Cell(90,12,$DisplayStuData['sl_regi'],1,0,'L');
$pdf->Cell(55,48,"../Assets/StudentsPhoto/$photo",1,0,'L');
$pdf->Cell(0,12,'',0,1);
$pdf->Cell(45,12,'Students Name',1,0,'L');
$pdf->Cell(90,12,$DisplayStuData['sl_name'],1,0,'L');
$pdf->Cell(0,12,'',0,1);
$pdf->Cell(45,12,'Fathers Name',1,0,'L');
$pdf->Cell(90,12,$DisplayStuData['sl_fatherName'],1,0,'L');
$pdf->Cell(0,12,'',0,1);
$pdf->Cell(45,12,'Mothers Name',1,0,'L');
$pdf->Cell(90,12,$DisplayStuData['sl_motherName'],1,0,'L');
$pdf->Cell(0,12,'',0,1);
$pdf->Cell(20,8,'D.O.B',1,0,'L');
$pdf->Cell(48,8,$DisplayStuData['sl_dob'],1,0,'L');
$pdf->Cell(20,8,'Class',1,0,'L');
$pdf->Cell(20,8,$displayclass['cl_name'],1,0,'L');
$pdf->Cell(20,8,'Roll No',1,0,'L');
$pdf->Cell(20,8,$displaystuclass['SCL_rollno'],1,0,'L');
$pdf->Cell(20,8,'Section',1,0,'L');
$pdf->Cell(22,8,'A',1,1,'L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,12,'Examination Programme',1,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,16,'Date / Day',1,0,'C');
$pdf->Cell(70,8,'1st Sitting',1,0,'C');
$pdf->Cell(70,8,'2nd Setting',1,1,'C');
$pdf->Cell(50,8,'',0,0);
$pdf->Cell(70,8,'08:00 AM to 11:00 AM',1,0,'C');
$pdf->Cell(70,8,'12:00 AM to 02:00 PM',1,1,'C');
while($displayexamtimetable = mysqli_fetch_array($examtimetable)){
$pdf->Cell(50,8,$displayexamtimetable['acl_Day']." / ".$displayexamtimetable['acl_ExamiDate'],1,0,'C');
$pdf->Cell(70,8,$displayexamtimetable['acl_1stSettingSub'],1,0,'C');
$pdf->Cell(70,8,$displayexamtimetable['acl_2ndSettingSub'],1,1,'C');
}
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,8,'Examination Instruction to Students',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,'1. Check the exam. Timetable carefully.',0,1,'L');
$pdf->Cell(0,8,'2. Students must bring their lunch to school.',0,1,'L');
$pdf->Cell(0,8,'3. Student must bring the admit card and show iti to the  invigilator(s) on durty and school preserve it for feture requirements.',0,1,'L');
$pdf->Cell(0,8,'4. Mobile Phone, Calculator, Digital Watch, or any Electronic Device is not Allowed.',0,1,'L');
$pdf->Output();
?>