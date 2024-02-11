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
    $class_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectClass = mysqli_query($conn, "SELECT * FROM announcementslist WHERE AL_id ='$class_id'");
    $FatchClass = mysqli_fetch_assoc($selectClass);
?>

<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Modify Announcements list Principal Dashboard - S S Convent Sarbahda</title>
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
                                <a href="index.php" class="btn btn-sm btn-outline-danger rounded-pill"> <i class="fa-solid fa-backward"></i> Back</a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Upgrade Announcements</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $annoDate = get_safe_value($conn,$_POST['AnnDate']);
                                            $usertype = get_safe_value($conn, $_POST['usertype']);
                                            $annType = get_safe_value($conn, $_POST['annoType']);
                                            $subject = get_safe_value($conn, $_POST['subjects']);
                                            $message = get_safe_value($conn, $_POST['message']);
                                            // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM announcementslist WHERE AL_subject='$subject'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Notice name exit here. Try another Notice.</div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO announcementslist(AL_Announments_date, AL_forUser, AL_type, AL_subject, AL_Message)  VALUES('$annoDate','$usertype','$annType','$subject','$message')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Add Notice here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully add Notice here.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="date" class="form-control" name="AnnDate" id="floatingADate" placeholder="Announcements Date" value="<?php echo $FatchClass['AL_Announments_date']; ?>">
                                      <label for="floatingADate">Announcements Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="usertype" aria-label="Floating label  select example" >
                                        <option selected>Select user type</option>
                                        <option value="All" <?php if($FatchClass['AL_forUser']=='All'){echo "selected";} ?>>All</option>
                                        <option value="Students" <?php if($FatchClass['AL_forUser']=='Students'){echo "selected";} ?>>Students</option>
                                        <option value="Teacher" <?php if($FatchClass['AL_forUser']=='Teacher'){echo "selected";} ?>>Teacher</option>
                                        <option value="Operator" <?php if($FatchClass['AL_forUser']=='Operator'){echo "selected";} ?>>Operator</option>
                                      </select>
                                      <label for="floatingSelect">Select user type</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingannoType" name="annoType" aria-label="Floating label  select example" >
                                        <option selected>Select Annou. type</option>
                                        <option value="Announcement" <?php if($FatchClass['AL_type']=='Announcement'){echo "selected";} ?>>Announcement</option>
                                        <option value="Events" <?php if($FatchClass['AL_type']=='Events'){echo "selected";} ?>>Events</option>
                                      </select>
                                      <label for="floatingannoType">Select Annou. type</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="subjects" id="floatingSubject" placeholder="Announcements Date" value="<?php echo $FatchClass['AL_subject']; ?>">
                                      <label for="floatingSubject">Subject</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" placeholder="Leave a comment here" name="message" id="floatingTextarea"><?php echo $FatchClass['AL_Message']; ?></textarea>
                                      <label for="floatingTextarea">Message</label>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">UPGRADE</button>
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