<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
    //Data Fetch query  
    $stu_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectStuData = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_id ='$stu_id'");
    $showStuData = mysqli_fetch_assoc($selectStuData);
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Upgrade Students Photo - Principal Dashboard Students Success Convent, Sarbahda, Gaya</title>
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
        <div class="container">
            <?php 
            if(isset($_POST['postsubmit'])){
              if (isset($_POST['g-recaptcha-response'])) {
              $secretAPIkey = '6Ld-fWIhAAAAANkoZfwpkFAtboLbQRatC2l24YXu';
              // reCAPTCHA response verification
              $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
              // Decode JSON data
              $response = json_decode($verifyResponse);
              if($response->success){
                $thumnails_id = $showStuData['sl_id'];
                $old_thumnails = get_safe_value($conn, $_POST['old_thumnails']);
                // Image
                  $filename = $_FILES["postThumbnail"]["name"];
                  $tempname = $_FILES["postThumbnail"]["tmp_name"];
                  $filesize = $_FILES["postThumbnail"]["size"];
                  $img = imagecreatefromjpeg($_FILES["postThumbnail"]["tmp_name"]);
                  $file_name=time().'.jpg';    
                  $folder = "../Assets/StudentsPhoto/".$file_name;
                  $allowed_image_extension = array("jpg","jpeg");
                  echo "<pre>";
                  if($filename !='' ){
                    $update_thumails = $file_name;
                  }elseif(!in_array($filename,$allowed_image_extension)){
                    $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Upload valid Image. Only JPG, and JPEG are allowed. </div>";
                  }elseif($_FILES["postThumbnail"]["size"]>5000){
                    $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Image file size under 50 kb.</div>";
                  }
                  else{
                    $update_thumails = $old_thumnails;
                  }
                  $upload_thumnails = mysqli_query($conn, "UPDATE studentlist SET sl_photo ='$update_thumails' WHERE sl_id ='$thumnails_id' ");
                    if($upload_thumnails){
                        if($_FILES["postThumbnail"]["name"] != ''){
                            // Now let's move the uploaded image into the folder: image
                            if (move_uploaded_file($tempname, $folder))  {
                                unlink("../Assets/StudentsPhoto/".$old_thumnails);
                              $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>Image uploaded successfully</div>";
                                ?>
                                <script>
                                    //window.location.replace("studentList.php");
                                </script>
                                <?php
                                exit;
                            }else{
                              $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>Failed upload to Image</div>";
                            }
                        }
                        else{
                            $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>You haven't Successful upload Thumnail in folder.</div>";
                        }  
                    }
                    else{
                        $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hey! </strong>You haven't Successful upload Thumnails.</div>";
                    }
                }
                else{
                  $_SESSION['status'] = "<div class='alert alert-warning'><strong</strong>Choose Google captcha.</div>";
                }
              }
            }
            ?>
            <?php 
                if (isset($_SESSION['status'])) {
                  echo $_SESSION['status'];
                  unset($_SESSION['status']);
                }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mt-3">
                            <input type="hidden" name="old_thumnails" value="<?php echo $showStuData['sl_photo']; ?>">
                            <input type="file" name="postThumbnail">
                        </div>
                        <div class="form-group mb-3 mt-3 d-flex justify-content-center">
                          <div class="g-recaptcha" data-sitekey="6Ld-fWIhAAAAABJUaDvFBVOWuwJVen907O0o1TpG"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                          <button class="btn btn-outline-warning rounded-pill mt-2" type="submit" name="postsubmit">Upgrade</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
        </main>
        <?php include('Includes/footer.php'); ?>
    </div>
</div>
<?php include ('Includes/script.php');?>
<?php include('Includes/foot.php'); ?>