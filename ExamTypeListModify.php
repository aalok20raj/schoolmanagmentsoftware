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
    $selectEntry = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Exam Type List Modify Principal Dashboard - S S Convent Sarbahda</title>
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
                                <a href="ExamTypeList.php" class="btn btn-sm btn-outline-danger rounded-pill"> <i class="fa-solid fa-backward"></i> Back</a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="" class="btn btn-sm btn-outline-danger rounded-pill">Add</a>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Modify Exam. Type</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $fatchId = $DisplayEntry['ex_id'];
                                            $entryname = get_safe_value($conn, $_POST['Entrname']);
                                            $entrydate = get_safe_value($conn,$_POST['entryDate']);
                                            $examInst = get_safe_value($conn, $_POST['examInstruction']);
                                            

                                                   $upgradedate = mysqli_query($conn, "UPDATE examlist SET ex_name='$entryname',ex_public_date='$entrydate',ex_inst='$examInst' WHERE ex_id='$fatchId'");
                                                    if($upgradedate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Submit here.</div>";
                                                        ?>
                                                        <script>
                                                            window.location.replace("ExamTypeList.php");
                                                        </script>
                                                        <?php
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Submit here.</div>";
                                                    }
                                                
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="Entrname" id="floatingEntryname" value="<?php echo $DisplayEntry['ex_name']; ?>" placeholder="Full Name">
                                      <label for="floatingEntryname">Name</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="date" class="form-control" name="entryDate" id="floatingEntryDate" value="<?php echo $DisplayEntry['ex_public_date']; ?>" placeholder="Full Name">
                                      <label for="floatingEntryDate">Entry Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" placeholder="Leave a comment here" name="examInstruction" id="floatingTextarea"><?php echo $DisplayEntry['ex_inst']; ?></textarea>
                                      <label for="floatingTextarea">Examination Instruction</label>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">SUBMIT</button>
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