<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM enquirydatalist ORDER BY El_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['El_Regi_no'];
                $get_number = str_replace("SSCE", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 3, 0, STR_PAD_LEFT);
                $id = "SSCE".$get_string;
            }
        }
        else{
            $id ="SSCE001";
        }
    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'El_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE enquirydatalist SET El_status='$status' WHERE El_id='$SHid'");
      }
    }
    //Data Fetch query  
    $entry_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectEntry = mysqli_query($conn, "SELECT * FROM enquirydatalist WHERE El_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Class Payment List Principal Dashboard - S S Convent Sarbahda</title>
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
                                <a href="" class="btn btn-sm btn-outline-danger rounded-pill">Add</a>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Upgrade Entry</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $eID = $DisplayEntry['El_id'];
                                            $entrydate = get_safe_value($conn,$_POST['entryDate']);
                                            $entryname = get_safe_value($conn, $_POST['Entrname']);
                                            $mobileNumber = get_safe_value($conn, $_POST['EntryMobileNumber']);
                                            $WhatsappNumber = get_safe_value($conn, $_POST['EntryWhatsappNumber']);
                                            $ContactDate = get_safe_value($conn, $_POST['contactDate']);
                                            $Message = get_safe_value($conn, $_POST['message']);
                                            $upgradedate = get_safe_value($conn, $_POST['upDate']);

                                            $upgradeEntry = mysqli_query($conn, "UPDATE enquirydatalist SET El_Date='$entrydate', El_Name='$entryname', El_mobile='$mobileNumber', El_whatsappNo='$WhatsappNumber', El_meetDate='$ContactDate' , El_message= '$Message', El_upgradedate='$upgradedate' WHERE El_id='$eID'");
                                                    if($upgradeEntry){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Upgrade here.</div>";
                                                        ?>
                                                        <script>
                                                          window.location.href="EntryList.php";
                                                        </script>
                                                        <?php
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Upgrade here.</div>";
                                                    }
                                                
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="date" class="form-control" name="entryDate" id="floatingEntryDate" value="<?php echo $DisplayEntry['El_Date'];?>" placeholder="Full Name">
                                      <label for="floatingEntryDate">Entry Date</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="Entrname" id="floatingEntryname" value="<?php echo $DisplayEntry['El_Name'];?>" placeholder="Full Name">
                                      <label for="floatingEntryname">Name</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="EntryMobileNumber" id="floatingMobile" value="<?php echo $DisplayEntry['El_mobile'];?>" placeholder="Full Name">
                                      <label for="floatingMobile">Mobile Number</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="EntryWhatsappNumber" id="floatingEntryWhatsappNumber" value="<?php echo $DisplayEntry['El_whatsappNo'];?>" placeholder="Full Name">
                                      <label for="floatingEntryWhatsappNumber">Whatsapp Number</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="date" class="form-control" name="contactDate" id="floatingContactDate" value="<?php echo $DisplayEntry['El_meetDate'];?>" placeholder="Full Name">
                                      <label for="floatingContactDate">Contact Date</label>
                                    </div>
                                    <div class="form-floating">
                                      <textarea class="form-control mb-2" name="message" placeholder="" id="floatingTextarea"><?php echo $DisplayEntry['El_message'];?></textarea>
                                      <label for="floatingTextarea">Write Message</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="hidden" class="form-control" name="upDate" id="floatingUpdate" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('d-M-Y h:i:s A'); ?>" placeholder="Upgrade Date">
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

<?php include('Includes/foot.php'); ?>