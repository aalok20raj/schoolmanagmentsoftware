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
    $entry_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectEntry = mysqli_query($conn, "SELECT * FROM userlisting WHERE ul_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Password Upgrade Principal Dashboard - S S Convent Sarbahda</title>
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
                        <div class="row mt-3 mb-3">
                            <div class="col-md-6">
                                <a href="" class="btn btn-sm btn-outline-danger rounded-pill"> <i class="fa-solid fa-backward"></i> Back</a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="userList.php" class="btn btn-sm btn-outline-danger rounded-pill">Go User List</a>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Upgrade Password</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $uPass = $DisplayEntry['ul_id'];
                                            $password = get_safe_value($conn, $_POST['pass']);
                                            $cpassword = get_safe_value($conn, $_POST['cpass']);
                                            $pass = password_hash($password, PASSWORD_BCRYPT);
                                            $upgradepass = mysqli_query($conn, "UPDATE userlisting SET ul_password='$pass' WHERE ul_id='$uPass'");
                                                    
                                                    if($upgradepass){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Upgrade Password</div>";
                                                        ?>
                                                        <script>
                                                          window.location.href="userList.php";
                                                        </script>
                                                        <?php
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Upgrade Password</div>";
                                                    }
                                                
                                            
                                        }
                                    }
                                }
                                ?>
                                <form method="POST">
                                    
                                    <div class="form-floating mb-3">
                                      <input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password">
                                      <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="password" class="form-control" name="cpass" id="floatingCPassword" placeholder="Password">
                                      <label for="floatingCPassword">Confirm Password</label>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">Upgrade Password</button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                
                            </div>

                        </div>
                    </div>
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<?php include('Includes/foot.php'); ?>