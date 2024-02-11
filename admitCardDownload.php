<?php 
    session_start(); 
    include('Includes/config.php');
    include('Includes/function.php');
?>
<?php include('Includes/head.php'); ?>
    <title> Admit Card - STUDENTS SUCCESS CONVENT SCHOOL SARBAHDA GAYA, BIHAR</title>
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
    <div class="container-fluid bg-primary text-white">
        <h1 class="pt-5 pb-5 text-center">Admit Card</h1>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="w-50 col-md-1">
            <form method="post" action="">
                <div class="form-floating pb-2">
                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Examination Name</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <label for="floatingSelect">Choose Examination</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" placeholder="Registration No">
                  <label for="floatingInput">Registration Number</label>
                </div>
                <button class="btn btn-outline-danger float-right">Search</button>
            </form>
        </div>
    </div>
<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>
