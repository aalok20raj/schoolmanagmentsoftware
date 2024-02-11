<?php 
    session_start(); 
    include('Includes/config.php');
    include('Includes/function.php');
?>
<?php include('Includes/head.php'); ?>
    <title>User Login - STUDENTS SUCCESS CONVENT SCHOOL SARBAHDA GAYA, BIHAR</title>
<?php 
include('Includes/header.php'); 
include('Includes/nav.php');

?>
<div class="container-fluid p-5 bg-primary">
    <h1 class="text-center text-white">Student Login</h1>
</div>
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-md-8">
            <h1 class="text-center font-weight-bold">Instructions for Login</h1>
            <ul>
                <li>User ध्यान दें, अपना Username/ इमेज और पासवर्ड दूसरे के साथ शेयर ना करें|</li>
                <li>यदि आप पहले बार Login कर रहे हैं तो आपके Email पर एक Mail गया होगा, उस पर क्लिक करें उसके बाद Login कर पाएंगे| <a href="" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-search"></i> कैसे करें</a></li>
                <li>Login  कहने के लिए, User अपना Username  या Email Address और Password  का उपयोग करें, और आपके Email Address पर एक OTP जायेगा, वह OTP यहाँ पर insert करने के बाद आप सफल पूर्वक Login कर पायेंगे | <a href="" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-search"></i> कैसे करें</a></li>

                <li>User ध्यान दें काम पूरा  हो जाने के बाद अपना Account को SigOut जरूर करें| </li>

                <li>यदि आप अपना पासवर्ड भूल गए हैं तो आप Forget  Password  पर क्लिक करके अपना पासवर्ड फिर से Generate  कर सकते हैं| <a href="" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-search"></i> कैसे करें</a></li>
                <li>कॉलेज से जुड़े, किसी भी मदद के लिए Website के होम  पेज Top में दिए गये Help button के आप अपना Problem को शेयर करें या आप WhatsAPP मध्यमा से अपना Problem को शेयर कर के मदद ले सकते हैं| <a href="" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-search"></i> कैसे करें</a></li>
            </ul>
        </div>
        <div class="col-md-4 pt-5 pb-5">
            <?php 
                if (isset($_POST['user_login'])) {
                    // if (isset($_POST['g-recaptcha-response'])) {
                    // $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                    // // reCAPTCHA response verification
                    // $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                    // // Decode JSON data
                    // $response = json_decode($verifyResponse);
                    // if($response->success){
                    $Username = get_safe_value($conn,$_POST['Email']);
                    $Password = get_safe_value($conn,$_POST['password']);
                    $userNameQuery = "SELECT * FROM userlisting WHERE ul_email = '$Username'";
                    $checkUserName = mysqli_query($conn, $userNameQuery);
                    $userNameCount = mysqli_num_rows($checkUserName);
                    if ($userNameCount) {
                      $userPassword = mysqli_fetch_assoc($checkUserName);
                      $db_pass = $userPassword['ul_password'];
                      $_SESSION['ul_email'] =  $userPassword['ul_email'];
                                      // setcookie('ul_email',$userPassword['ul_email'],time()+60*60*24*30);
                      $pass_docode = password_verify($Password, $db_pass);
                      //if($userPassword['M_u_attempt'] == 0){
                      if ($userPassword['ul_status']==1) {
                      if ($pass_docode) {
                        // $usern = $_SESSION['ul_email'];
                        // $system_attempt_login = '1';
                        //                 // setcookie('M_u_attempt',$userPassword['M_u_attempt'],time()+60*60*24*30);
                        // $system_login_status = "UPDATE userlisting SET M_u_attempt ='$system_attempt_login' WHERE ul_email='$usern'";
                        // $update_s_login_query = mysqli_query($conn, $system_login_status);
                        // 
                        ?>
                        <script>
                          window.location.href="BackEnd/Principal/index.php";
                        </script>
                        <?php
                                                                              
                      }
                      else{
                        $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Password doesn't match!, Try any.</div>";
                     }
                    }
                    else{
                            $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Your Account Deactive. Please Contact Office.</div>";
                    }
                    //}
                    // else{
                    //                     $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>login in another place, you Logout it there then you will log in here</div>";
                    //                 }
                                  }
                                    else{
                                      $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Username doesn't match!, try any.</div>";
                                    }
                                    }
                                      else{
                                        $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Choose Google captcha.</div>";
                                      }
                                  //   }
                                  // }
            ?>
            <div class="container-fluid h3 text-center rounded-top p-3 bg-warning">Student Login Here</div>
            <?php 
              if (isset($_SESSION['status'])) {
                echo $_SESSION['status'];
                unset($_SESSION['status']);
                }
            ?>
            <form method="post">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" name="Email" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">Password</label>
                </div>
                <div class="mb-2  mt-2 d-flex justify-content-center">
                    <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" name="user_login" class="btn btn-outline-primary rounded-pill"><i class="fas fa-sign-in-alt"></i> Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>
