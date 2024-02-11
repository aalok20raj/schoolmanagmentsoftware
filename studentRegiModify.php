<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>

<?php 
    //Data Fetch query  
    $post_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectPost = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_id ='$post_id'");
    $FatchPost = mysqli_fetch_assoc($selectPost);
    
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Students Registration Form Modify - Prinical Dashboard Students Success Convent</title>
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
                            <a href="studentList.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="bi bi-skip-backward font-weight-bold"></i> Back</a>
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
                                            $userid = $FatchPost['sl_id'];
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

                                            
                                            $insertPost = mysqli_query($conn, "UPDATE studentlist SET sl_regi_date='$studRegDate',sl_name='$name',sl_fatherName='$father',sl_motherName='$mother',sl_gradName='$gauradian',sl_dob='$dob',sl_gender='$gender',sl_category='$category',sl_nationality='$religion',sl_caddress='$caddress',sl_paddress='$paddress',sl_contentNumber='$mobile',sl_alternativeNumber='$amobile',sl_emailAddress='$email' WHERE sl_id='$userid' ");
                                            if($insertPost){
                                              $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong> You have Successfully Upgrade Data.</div>";
                                                ?>
                                                <script>
                                                    window.location.replace("studentList.php");
                                                </script>
                                                <?php
                                                exit;
                                              }else{
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong> You haven't Successful Upgrade Data.</div>";
                                              }
                                        }
                                    }
                                }
                        ?>
                        <form method="POST" action="" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="Registration" id="floatingRegi" placeholder="Registration Number" value="<?php echo $FatchPost['sl_regi']; ?>" readonly >
                                      <label for="floatingRegi">Registration Number</label>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="Date" class="form-control" name="RegiDate" id="floatingRegi" value="<?php echo $FatchPost['sl_regi_date']; ?>"  placeholder="Registration Date">
                                      <label for="floatingRegi">Registration Date</label>
                                    </div>
                                </div>
                            </div>
                            <h4>Personal  Information</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="StuName" id="floatingName" value="<?php echo $FatchPost['sl_name']; ?>" placeholder="Student's Name">
                                      <label for="floatingName">Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="FathName" id="Father's Name" value="<?php echo $FatchPost['sl_fatherName']; ?>" placeholder="Father's Name">
                                      <label for="Father's Name">Father's Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="MothName"  id="flaotingMother" value="<?php echo $FatchPost['sl_motherName']; ?>" placeholder="Mother's Name">
                                      <label for="flaotingMother">Mother's Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="GuarName" id="Floatingguardian" value="<?php echo $FatchPost['sl_gradName']; ?>" placeholder="Guardian's Name">
                                      <label for="Floatingguardian">Guardian Name<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <input type="date" class="form-control" name="DOB" id="dateOfBirth" value="<?php echo $FatchPost['sl_dob']; ?>" placeholder="dateOfBirth">
                                      <label for="dateOfBirth">Date of Birth<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingGender" name="Gender" aria-label="Floating label select example">
                                        <option selected>Select Gender</option>
                                        <option value="Male" <?php if($FatchPost['sl_gender']=='Male'){echo "selected";} ?>>Male</option>
                                        <option value="Female"<?php if($FatchPost['sl_gender']=='Female'){
                                            echo "selected";
                                        } ?>>Female</option>
                                        <option value="Other"<?php if($FatchPost['sl_gender']=='Other'){
                                            echo "selected";
                                        } ?>>Other</option>
                                      </select>
                                      <label for="floatingGender">Gender</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingCategory" name="Category" aria-label="Floating label select example">
                                        <option selected>Select Category</option>
                                        <option value="Genderal" <?php if($FatchPost['sl_category']=='Genderal'){echo "selected";} ?>>Genderal</option>
                                        <option value="OBC" <?php if($FatchPost['sl_category']=='OBC'){echo "selected";} ?>>OBC</option>
                                        <option value="EBC" <?php if($FatchPost['sl_category']=='EBC'){echo "selected";} ?>>EBC</option>
                                        <option value="SC" <?php if($FatchPost['sl_category']=='SC'){echo "selected";} ?>>SC</option>
                                        <option value="ST" <?php if($FatchPost['sl_category']=='ST'){echo "selected";} ?>>ST</option>
                                        <option value="Other"<?php if($FatchPost['sl_category']=='Other'){echo "selected";} ?>>Other</option>
                                      </select>
                                      <label for="floatingCategory">Category</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingreligion" name="religion" aria-label="Floating label select example">
                                        <option selected>Select Religion</option>
                                        <option value="Hindu"<?php if($FatchPost['sl_nationality']=='Hindu'){echo "selected";} ?>>Hindu</option>
                                        <option value="Islam" <?php if($FatchPost['sl_nationality']=='Islam'){echo "selected";} ?>>Islam</option>
                                        <option value="Christanity"<?php if($FatchPost['sl_nationality']=='Christanity'){echo "selected";} ?>>Christanity</option>
                                        <option value="Sikhism"<?php if($FatchPost['sl_nationality']=='Sikhism'){echo "selected";} ?>>Sikhism</option>
                                        <option value="Buddhism"<?php if($FatchPost['sl_nationality']=='Buddhism'){echo "selected";} ?>>Buddhism</option>
                                        <option value="Tribal"<?php if($FatchPost['sl_nationality']=='Tribal'){echo "selected";} ?>>Tribal</option>
                                        <option value="Jainism"<?php if($FatchPost['sl_nationality']=='Jainism'){echo "selected";} ?>>Jainism</option>
                                        <option value="Other"<?php if($FatchPost['sl_nationality']=='Other'){echo "selected";} ?>>Other</option>
                                      </select>
                                      <label for="floatingreligion">Religion</label>
                                    </div>
                                </div>
                            </div>
                            <h4>Contact Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" name="caddress" placeholder="Current Address" id="floatingCurrentAddress" ><?php echo $FatchPost['sl_caddress']; ?></textarea>
                                      <label for="floatingCurrentAddress">Current Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" name="paddress" placeholder="Permanent Address" id="floatingpermanentAddress" ><?php echo $FatchPost['sl_paddress']; ?></textarea>
                                      <label for="floatingpermanentAddress">Permanent Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="MobileNumber" id="floatingMobileNumber" value="<?php echo $FatchPost['sl_contentNumber']; ?>" placeholder="MobileNumber">
                                      <label for="floatingMobileNumber">Mobile Number<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" name="AmobileNumber" id="floatingAMobileNumber" value="<?php echo $FatchPost['sl_alternativeNumber']; ?>" placeholder="Alternative MobileNumber">
                                      <label for="floatingAMobileNumber">A. Mobile Number<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control"  name="EmailAddress" id="floatingEmail" value="<?php echo $FatchPost['sl_emailAddress']; ?>" placeholder=" Email Address">
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