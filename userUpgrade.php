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
        <title>User List Principal Dashboard - S S Convent Sarbahda</title>
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
                                <a href="userList.php" class="btn btn-sm btn-outline-danger rounded-pill">Go to Userlist</a>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">User Registration</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $userid = $DisplayEntry['ul_id'];
                                            $name = get_safe_value($conn,$_POST['name']);
                                            $mobile = get_safe_value($conn, $_POST['mobile']);
                                            $email = get_safe_value($conn, $_POST['email']);
                                            $user = get_safe_value($conn, $_POST['usertype']);
                                            $upgradeuser = mysqli_query($conn, "UPDATE userlisting SET ul_Name='$name', ul_mobile='$mobile', ul_email='$email', ul_role='$user' WHERE ul_id='$userid'");
                                                    
                                                    if($upgradeuser){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Upgrade Data.</div>";
                                                        ?>
                                                        <script>
                                                          window.location.href="userList.php";
                                                        </script>
                                                        <?php
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Upgrade Data.</div>";
                                                    }
                                            
                                            
                                        }
                                    }
                                }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="name" id="floatingName" value="<?php echo $DisplayEntry['ul_Name'];?>" placeholder="Full Name">
                                      <label for="floatingName">Full Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="mobile" class="form-control" name="mobile" id="floatingMobile" value="<?php echo $DisplayEntry['ul_mobile'];?>" placeholder="Mobile Number">
                                      <label for="floatingMobile">Mobile Number</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="email" class="form-control" name="email" id="floatingEmail" value="<?php echo $DisplayEntry['ul_email'];?>" placeholder="name@example.com">
                                      <label for="floatingEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="usertype" aria-label="Floating label  select example" >
                                        <option selected>Select user type</option>
                                        <option value="Principle" <?php if($DisplayEntry['ul_role']=='Principle'){echo "selected";} ?>>Principle</option>
                                        <option value="Teacher" <?php if($DisplayEntry['ul_role']=='Teacher'){echo "selected";} ?>>Teacher</option>
                                        <option value="Operator" <?php if($DisplayEntry['ul_role']=='Operator'){echo "selected";} ?>>Operator</option>
                                      </select>
                                      <label for="floatingSelect">Select user type</label>
                                    </div>
                                    
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">Upgrade</button>
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
<?php include('Includes/foot.php'); ?>