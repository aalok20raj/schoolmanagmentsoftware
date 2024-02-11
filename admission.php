<?php 
    session_start(); 
    include('Includes/config.php');
    include('Includes/function.php');
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['sl_regi'];
                $get_number = str_replace("SSCS", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
                $id = "SSCS".$get_string;
            }
        }
        else{
            $id ="SSCS0001";
        }
?>
<?php include('Includes/head.php'); ?>
    <title> Admission - STUDENTS SUCCESS CONVENT SCHOOL SARBAHDA GAYA, BIHAR</title>
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
        <h1 class="pt-5 pb-5 text-center">Online Admission 2023-24</h1>
    </div>
    <div class="container pt-5 d-flex justify-content-center">
        <form method="POST" action="" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="Registration" id="floatingRegi" placeholder="Registration Number" readonly value="<?php echo $id; ?>" >
                                      <label for="floatingRegi">Registration Number</label>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="Date" class="form-control" name="RegiDate" id="floatingRegi" placeholder="Registration Date">
                                      <label for="floatingRegi">Registration Date</label>
                                    </div>
                                </div>
                            </div>
                            <h4>Personal  Information</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="StuName" id="floatingName" placeholder="Student's Name">
                                      <label for="floatingName">Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="FathName" id="Father's Name" placeholder="Father's Name">
                                      <label for="Father's Name">Father's Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="MothName" id="flaotingMother" placeholder="Mother's Name">
                                      <label for="flaotingMother">Mother's Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="GuarName" id="Floatingguardian" placeholder="Guardian's Name">
                                      <label for="Floatingguardian">Guardian Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <input type="date" class="form-control" name="DOB" id="dateOfBirth" placeholder="dateOfBirth">
                                      <label for="dateOfBirth">Date of Birth<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingGender" name="Gender" aria-label="Floating label select example">
                                        <option selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                      </select>
                                      <label for="floatingGender">Gender</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingCategory" name="Category" aria-label="Floating label select example">
                                        <option selected>Select Category</option>
                                        <option value="Genderal">Genderal</option>
                                        <option value="OBC">OBC</option>
                                        <option value="EBC">EBC</option>
                                        <option value="SC">SC</option>
                                        <option value="ST">ST</option>
                                        <option value="Other">Other</option>
                                      </select>
                                      <label for="floatingCategory">Category</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingreligion" name="religion" aria-label="Floating label select example">
                                        <option selected>Select Religion</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Christanity">Christanity</option>
                                        <option value="Sikhism">Sikhism</option>
                                        <option value="Buddhism">Buddhism</option>
                                        <option value="Tribal">Tribal</option>
                                        <option value="Jainism">Jainism</option>
                                        <option value="Other">Other</option>
                                      </select>
                                      <label for="floatingreligion">Religion</label>
                                    </div>
                                </div>
                            </div>
                            <h4>Contact Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" name="caddress" placeholder="Current Address" id="floatingCurrentAddress" ></textarea>
                                      <label for="floatingCurrentAddress">Current Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" name="paddress" placeholder="Permanent Address" id="floatingpermanentAddress" ></textarea>
                                      <label for="floatingpermanentAddress">Permanent Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="MobileNumber" id="floatingMobileNumber" placeholder="MobileNumber">
                                      <label for="floatingMobileNumber">Mobile Number<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="AmobileNumber" id="floatingAMobileNumber" placeholder="Alternative MobileNumber">
                                      <label for="floatingAMobileNumber">A. Mobile Number<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="EmailAddress" id="floatingEmail" placeholder=" Email Address">
                                      <label for="floatingEmail">Email Address<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div class="col-md-3">
                                    <div class="d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-warning rounded-pill" type="submit" name="StuRegSubmit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
    </div>
<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>
