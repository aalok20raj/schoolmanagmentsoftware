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
    $selectEntry = mysqli_query($conn, "SELECT * FROM admitcardlist WHERE acl_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
    
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admit Card Modify Principal Dashboard - S S Convent Sarbahda</title>
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
                                <a href="admitCardList.php" class="btn btn-sm btn-outline-danger rounded-pill"> <i class="fa-solid fa-backward"></i> Back</a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <!-- <a href="" class="btn btn-sm btn-outline-danger rounded-pill">Add</a> -->
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Modify Admit Card</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $admitId = $DisplayEntry['acl_id'];
                                            $examtype = get_safe_value($conn,$_POST['examType']);
                                            $class = get_safe_value($conn,$_POST['classn']);
                                            $examDay = get_safe_value($conn,$_POST['day']);
                                            $examDate = get_safe_value($conn,$_POST['examDate']);
                                            $FirstSSub = get_safe_value($conn,$_POST['FirstSettingSub']);
                                            $FirstTime = get_safe_value($conn,$_POST['FirstSettingSTime']);
                                            $SecondSSub = get_safe_value($conn,$_POST['SecondSettingSub']);
                                            $SecondTime = get_safe_value($conn,$_POST['SecondSettingTime']);
                                            // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM admitcardlist WHERE acl_examType='$examtype' && acl_Class='$class' && acl_Day='$examDay' && acl_ExamiDate='$examDate'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Examination Exit Here. Try Another Date of Exam. /div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "UPDATE admitcardlist SET acl_examType='$examtype',acl_Class='$class',acl_Day='$examDay',acl_ExamiDate='$examDate',acl_1stSettingSub='$FirstSSub',acl_1stSettingTime='$FirstTime',acl_2ndSettingSub='$SecondSSub',acl_2ndSettingTime='$SecondTime' WHERE acl_id='$admitId'");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Add Examination Date here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully add Exmination Date here.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="examType" aria-label="Floating label  select example" >
                                        <option selected>Select Exam. Type</option>
                                        <?php 
                                        $selectCla = mysqli_query($conn, "SELECT * FROM examlist ORDER BY ex_id DESC");
                                        while($selectclass = mysqli_fetch_array($selectCla)){
                                            if($selectclass['ex_status']==1){
                                            ?>
                                            <option value="<?php $selectclass['ex_id']?>" <?php $exmId= $selectclass['ex_id']; $admId=$DisplayEntry['acl_examType'];
                                            if($exmId == $admId){ echo "selected"; }?>><?php echo $selectclass['ex_name']?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                      </select>
                                      <label for="floatingSelect">Examination Type</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="classn" aria-label="Floating label  select example" >
                                        <option selected>Select Class</option>
                                        <?php 
                                        $selectCla = mysqli_query($conn, "SELECT * FROM classlist ORDER BY cl_id DESC");
                                        while($selectclass = mysqli_fetch_array($selectCla)){
                                            if($selectclass['cl_status']==1){
                                            ?>
                                            <option value="<?php echo $selectclass['cl_id']?>" <?php $claId= $selectclass['cl_id']; $eclaId=$DisplayEntry['acl_Class'];
                                            if($claId == $eclaId){ echo "selected"; }?>><?php echo $selectclass['cl_name']?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                      </select>
                                      <label for="floatingSelect">Class</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="day" aria-label="Floating label  select example" >
                                        <option selected>Select Exam. Day</option>
                                        <option value="Mon"<?php if('Mon' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Mon</option>
                                        <option value="Tue" <?php if('Tue' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Tue</option>
                                        <option value="Wed" <?php if('Wed' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Wed</option>
                                        <option value="Thu" <?php if('Thu' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Thu</option>
                                        <option value="Fri" <?php if('Fri' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Fri</option>
                                        <option value="Sat" <?php if('Sat' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Sat</option>
                                        <option value="Sun" <?php if('Sun' == $DisplayEntry['acl_Day']){ echo "selected"; }?>>Sun</option>
                                      </select>
                                      <label for="floatingSelect">Examination Day</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="Date" class="form-control" name="examDate" id="floatingName" value="<?php echo $DisplayEntry['acl_ExamiDate']; ?>" placeholder="Full Name">
                                      <label for="floatingName">Examination Date</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="FirstSettingSub" id="floatingName" value="<?php echo $DisplayEntry['acl_1stSettingSub']; ?>" placeholder="Full Name">
                                      <label for="floatingName">1st Setting Subject</label>
                                      
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="FirstSettingSTime" id="floatingName" value="<?php echo $DisplayEntry['acl_1stSettingTime']; ?>"  placeholder="Full Name">
                                      <label for="floatingName">1st Setting Exam. Start Time</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" value="<?php echo $DisplayEntry['acl_2ndSettingSub']; ?>"  class="form-control" name="SecondSettingSub" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">2nd Setting Subject</label>
                                      
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="SecondSettingTime" id="floatingName" value="<?php echo $DisplayEntry['acl_2ndSettingTime']; ?>"  placeholder="Full Name">
                                      <label for="floatingName">2nd Setting Exam. Start Time</label>
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