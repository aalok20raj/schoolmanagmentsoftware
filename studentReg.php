<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
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
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Students Registration Form - Prinical Dashboard Students Success Convent</title>
<?php 
    include('Includes/header.php'); 
    include('Includes/topNav.php');
?>
<div id="layoutSidenav">
<?php 
    include('Includes/SideBarNav.php');
?>            
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row mb-3 mt-3">
                          <div class="col-md-6">
                            <a href="index.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="bi bi-skip-backward font-weight-bold"></i> Back</a>
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <a href="StudentRegistration.php" class="btn btn-outline-primary rounded-pill btn-sm"><i class="bi bi-plus-circle-fill"></i> Add</a>
                          </div>
                        </div>
                        <?php 
                            if(isset($_POST['StuRegSubmit'])){
                                if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $studRegNo = get_safe_value($conn, $_POST['Registration']);
                                            $studRegDate = get_safe_value($conn, $_POST['RegiDate']);
                                            $name = get_safe_value($conn, $_POST['StuName']);
                                            $father = get_safe_value($conn, $_POST['FathName']);
                                            $mother = get_safe_value($conn, $_POST['MothName']);
                                            $gauradian = get_safe_value($conn, $_POST['GuarName']);
                                            $dob = get_safe_value($conn, $_POST['DOB']);
                                            $gender = get_safe_value($conn, $_POST['Gender']);
                                            $category = get_safe_value($conn, $_POST['Category']);
                                            $religion = get_safe_value($conn, $_POST['religion']);
                                            $caddress = get_safe_value($conn, $_POST['caddress']);
                                            $paddress = get_safe_value($conn, $_POST['paddress']);
                                            $mobile = get_safe_value($conn, $_POST['MobileNumber']);
                                            $amobile = get_safe_value($conn, $_POST['AmobileNumber']);
                                            $email = get_safe_value($conn, $_POST['EmailAddress']);

                                            // verify Email Address
                                            $emailVerify = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_emailAddress='$email'");
                                            $count_verifyEmail = mysqli_num_rows($emailVerify);
                                            if($count_verifyEmail == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong> This Email Address exit here. Try another Email Address.</div>";
                                            }
                                            else{
                                                $insertData = mysqli_query($conn, "INSERT INTO studentlist(sl_regi, sl_regi_date, sl_name, sl_fatherName, sl_motherName, sl_gradName, sl_dob, sl_gender, sl_category, sl_nationality, sl_caddress, sl_paddress, sl_contentNumber, sl_alternativeNumber, sl_emailAddress) VALUES('$studRegNo','$studRegDate','$name','$father','$mother','$gauradian','$dob','$gender','$category','$religion','$caddress','$paddress','$mobile','$amobile','$email')");
                                                    if($insertData){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Registration here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Registration here.</div>";
                                                    }
                                            }
                                        }
                                    }
                                }
                        ?>
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
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<?php include('Includes/foot.php'); ?>