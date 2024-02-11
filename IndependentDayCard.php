<?php 
session_start();
include('Includes/config.php');
include('Includes/function.php');

if(isset($_POST['submit'])){
    try {
        $stuName = get_safe_value($conn,$_POST['names']);
        $FatName = get_safe_value($conn,$_POST['father']);
        $Class = get_safe_value($conn,$_POST['class']);
        $address = get_safe_value($conn,$_POST['addr']);

        header('content-type:image/jpeg');
        $font = "Teko-Bold.ttf";
        $image = imagecreatefromjpeg("indeInventedCard.jpg");
        $color = imagecolorallocate($image, 19,21,22);
        $stu = $stuName." , ".$FatName;
        imagettftext($image, 20, 0, 250, 235,$color, $font, $stu);
        imagettftext($image, 20, 0, 110, 278,$color, $font, $address);
        $file = time().'_'."123".'.JPEG';
        imagejpeg($image,$file);

        // download the certificate 
        if(file_exists($file)){
            header('Content-Disposition Transfer');
            header('Content-Type: application/image');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            unlink($file);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<?php include('Includes/head.php'); ?>
    <title>STUDENTS SUCCESS CONVENT SCHOOL - SARBAHDA GAYA, BIHAR</title>
    <meta name="keyword" content="students success convent, Sarbahda, ssconvent sarbahda, ssconvent sumit sir">
    <meta name="description" content="Students Success Convent is private school at Sarbahda, Gaya, Bihar. It Provides High Quality Education your students. These prepared of competitive exam Such as Sainik School, Netarhat School, NTSE, NLSTSE, INO, KVPY, etc. And prepares class play to 8th. Your Teacher is expert in this field">

    <meta name="author" content="Aalok20raj">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="Assets/Images/STUDENTS SUCCESS CONVENT LOGO Social Media Logo.jpg" sizes="16x16">
    <link rel="shortcut icon" type="image/png" href="Assets/Images/STUDENTS SUCCESS CONVENT LOGO Social Media Logo.jpg" sizes="16x16">
<?php 
include('Includes/header.php'); 
include('Includes/nav.php');
?>
<div class="container">
	<div class="row mt-4">
		<div class="col-md-4 ">
			<h3 class="bg-warning p-2 text-center rounded-top">Invitation Card Generate</h3>
			<form method="POST">
				<div class="form-floating mb-3">
				  <input type="text" class="form-control" name="names" id="floatingName" placeholder="Full Name">
				  <label for="floatingName">Full Name</label>
				</div>
				<div class="form-floating mb-3">
				  <input type="text" class="form-control" name="father" id="FatherName" placeholder="Father's Name">
				  <label for="FatherName">Father's Name</label>
				</div>
				<div class="form-floating">
				  <select class="form-select" id="floatingClass" name="class"  aria-label="Floating label select example">
				    <option selected>Select Class</option>
				    <option value="Play">Play</option>
				    <option value="LKG">LKG</option>
				    <option value="UKG">UKG</option>
				    <option value="1">I</option>
				    <option value="2">II</option>
				    <option value="3">III</option>
				    <option value="4">IV</option>
				    <option value="5">V</option>
				    <option value="6">VI</option>
				    <option value="7">VII</option>
				    <option value="8">VIII</option>
				    <option value="9">IX</option>
				    <option value="10">X</option>
				    <option value="11">XI</option>
				    <option value="12">XII</option>
				  </select>
				  <label for="floatingClass">Class</label>
				</div>
				<div class="form-floating mt-3">
				  <input type="text" class="form-control" name="addr" id="floatingaddress" placeholder="Address">
				  <label for="floatingaddress">Address</label>
				</div>
				<button type="submit" name="submit" class="btn btn-outline-danger rounded-pill mt-2">Generate Card</button>
			</form>
		</div>
	</div>
</div>
<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>