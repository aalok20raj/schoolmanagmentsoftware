<?php 
    session_start(); 
    include('Includes/config.php');
    include('Includes/function.php');
?>
<?php include('Includes/head.php'); ?>
    <title>Contact Us - STUDENTS SUCCESS CONVENT SCHOOL SARBAHDA GAYA, BIHAR</title>
<?php 
include('Includes/header.php'); 
include('Includes/nav.php');

?>
<div class="container-fluid p-5 bg-primary">
    <h1 class="text-center text-white">Contact Us</h1>
</div>
<div class="container-fluid p-0">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3615.6690378292246!2d85.21851011500581!3d25.011359583982912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x696f309a47a5a407%3A0xf7c3111444090690!2sStudents%20Success%20Convent!5e0!3m2!1sen!2sin!4v1676728199550!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="container pt-5 ">
    <div class="row">
        <div class="col-md-6">
            <div>
                <p>
                  <i class="fas fa-map-marker-alt bg-danger text-white p-3 rounded-circle"></i> <b>Office Address</b>
                </p>
                <p>Sarbahda Bazar, Dih Road, Gaya, Bihar</p>
              </div>
              <div>
                <p>
                  <i class="fas fa-phone-alt bg-danger text-white p-3 rounded-circle"></i> <b>Contact Info</b> <br>
                  <span><b>Mobile Number - </b>+91 6205386638,</span> 
                </p>
              </div>
              <div>
                <p>
                  <i class="fas fa-envelope-open-text bg-danger text-white p-3 rounded-circle"></i> studentssuccessconvent@gmail.com
                </p>
              </div>
              <div>
                <p>
                  <i class="far fa-clock bg-danger text-white p-3 rounded-circle"></i> <b>08:00 AM </b>to <b>05:00 PM</b> and Sunday Close
                </p>
              </div>
        </div>
        <?php 
        if(isset($_POST['user_login'])){
            if (isset($_POST['g-recaptcha-response'])) {
                $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                $response = json_decode($verifyResponse);
                if($response->success){
                    $name = get_safe_value($conn,$_POST['Name']);
                    $email = get_safe_value($conn,$_POST['Email']);
                    $mobile = get_safe_value($conn,$_POST['Mobile']);
                    $subject = get_safe_value($conn,$_POST['subject']);
                    $message = get_safe_value($conn,$_POST['message']);
                    // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM contactlist WHERE c_subject='$subject'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>Wait 24 Hrs. Try next day.</div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO contactlist(c_name, c_mobile, c_email_id, c_subject, c_message)  VALUES('$name','$email','$mobile','$subject','$message')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Contact.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Contact fill form. Try again.</div>";
                                                    }
                                                }
                }
            }
        }
        ?>
        <div class="col-md-6">
            <h1 class="text-center">Contact Form</h1>
            <form method="post">
                <div class="form-floating mb-3">
                  <input type="Name" class="form-control" name="Name" id="FloatingName" placeholder="Name">
                  <label for="FloatingName">Name</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" name="Email" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="Mobile" class="form-control" name="Mobile" id="floatingMobile" placeholder="Mobile">
                  <label for="floatingMobile">Mobile</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="Subject" class="form-control" name="subject" id="floatingSubject" placeholder="Subject">
                  <label for="floatingSubject">Subject</label>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                  <label for="floatingTextarea">Message</label>
                </div>
                <div class="mb-2  mt-2 d-flex justify-content-center">
                    <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" name="user_login" class="btn btn-outline-primary rounded-pill"><i class="fas fa-sign-in-alt"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>
