<?php 
require('../../Assets/fpdf/fpdf.php');
// A4 width : 219 mm;
// default margian : 10mm each side;
// writable horizontal : 219-(10*2) = 189 mm;

header('content-type:image/jpeg');
$font = "C:\Users\aalok\Downloads\Tillana\Tillana-Bold.ttf";
$time=time();
$image = imagecreatefromjpeg("../../Assets/Images/certificate.jpg");
$color = imagecolorallocate($image, 19, 21, 22);
$name = "ALOKRAJ";
imagettftext($image, 20, 0, 190, 180, $color, $font, "ALOK RAJ");

imagejpeg($image,"../../Assets/certificate/$time.jpg");
imagedestroy($image);

$pdf = new FPDF('p','mm', 'A4');
$pdf -> AddPage();
$pdf->Image("../../Assets/certificate/$time.jpg",0,0,210,148);
ob_end_clean();
$pdf->Output();
?>