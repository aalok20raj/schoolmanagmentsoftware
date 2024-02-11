<?php 
	session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
    if(isset($_FILES["webcam"]["tmp_name"])){
    	$tmpName = $_FILES["webcam"]["tmp_name"];
    	$imageName = date("Y.m.d")." - ".date("h.i.sa").'.jpeg';
    	move_uploaded_file($tmpName, '../Assets/StudentsPhoto/'.$imageName);
    	$date = date("Y/m/d")." & " . date("h:i:sa");
    	$upgradephoto = mysqli_query($conn, "INSERT INTO studentlist(sl_photo) VALUES('$imageName') ");
    }
?>