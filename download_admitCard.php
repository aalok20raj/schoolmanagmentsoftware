<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Principal Dashboard - Students Success Convent, Sarbahda, Gaya</title>
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
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Download Student Admit Card</div>
                                
                                <form action="viewadmitcard.php" method="POST">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelectExam" name="examname" aria-label="Floating label select example">
                                        <option selected>Choose Examination Type</option>
                                        <?php 
                                            $exam = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_status='1' ");
                                            while($displayexam = mysqli_fetch_array($exam)){
                                                ?>
                                                <option value="<?php echo $displayexam['ex_id']; ?>"><?php echo $displayexam['ex_name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                      </select>
                                      <label for="floatingSelectExam">Select Examination</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" name="class" id="floatingSelectClass" aria-label="Floating label select example">
                                        <option selected>Choose Class</option>
                                        <?php 
                                            $exam = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_status='1' ");
                                            while($displayexam = mysqli_fetch_array($exam)){
                                                ?>
                                                <option value="<?php echo $displayexam['cl_id']; ?>"><?php echo $displayexam['cl_name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                      </select>
                                      <label for="floatingSelectClass">Select Class</label>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">Search</button>
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