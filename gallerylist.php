<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    
    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'GL_Status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE gallerylist SET GL_Status='$status' WHERE GL_id='$SHid'");
      }
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gallery list Principal Dashboard - S S Convent Sarbahda</title>
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
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Add Gallery</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $name = get_safe_value($conn,$_POST['title']);
                                             $imageName = $_FILES['gallery']['name'];
                                            $galleryTmp = $_FILES['gallery']['tmp_name'];
                                            // Check if the file is an image
                                            $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                                echo "Only JPG, JPEG, PNG & GIF files are allowed.";
                                            } else {
                                                // Upload image to server
                                                $targetDirectory = "../Assets/Gallery/";
                                                $targetPath = $targetDirectory . $imageName;
                                                move_uploaded_file($galleryTmp, $targetPath);
                                                // do check mobile 
                                                $checkClass = mysqli_query($conn, "SELECT * FROM gallerylist WHERE GL_Title='$name'");
                                                $CountCheckClass = mysqli_num_rows($checkClass);
                                                if($CountCheckClass == 1){
                                                    $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>Try Again.</div>";
                                                }
                                                
                                                    else{

                                                        $insertDate = mysqli_query($conn, "INSERT INTO gallerylist(GL_Title, GL_Photo)  VALUES('$name','$imageName')");
                                                        if($insertDate){
                                                            $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Upload Image.</div>";
                                                        }
                                                        else{
                                                            $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Uplaoad Image.</div>";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST" enctype="multipart/form-data">
                                    
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="title" id="floatingSubject" placeholder="Announcements Date">
                                      <label for="floatingSubject">Title</label>
                                    </div>
                                    <label for="avatar">Choose a picture:</label>
                                    <input type="file" id="avatar" name="gallery" accept="image/png, image/jpeg" />
                                    <div class="mb-2 mt-3 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">Upload</button>
                                </form>
                            </div>
                            
                            <div class="col-md-8">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                        $fetch_data = mysqli_query($conn,"SELECT * FROM gallerylist ORDER BY GL_id DESC");
                                                        while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $fetch_dataLoop['GL_Photo']; ?>
                                                                    </td>
                                                                    
                                                                    <td><?php echo $fetch_dataLoop['GL_Title']; ?></td>
                                                                    
                                                                    <td>
                                                                        <?php 
                                                                          if ($fetch_dataLoop['GL_Status']==1) {
                                                                            echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=GL_Status&operation=deactive&id=".$fetch_dataLoop['GL_id']."'>Active<i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                          }
                                                                          else{
                                                                            echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=GL_Status&operation=active&id=".$fetch_dataLoop['GL_id']."'>Disactive<i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                          }
                                                                          ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="moditygallerylist.php?id=<?php echo $fetch_dataLoop['GL_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                          <a href="Password_forget.php?id=<?php echo $fetch_dataLoop['GL_id'];?>">|<i class="fas fa-unlock-alt ml-2 mr-1"></i></a>
                                                                          <a href="deleteusers.php?id=<?php echo $fetch_dataLoop['GL_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                          <a href="view_student_profile.php?id=<?php echo $fetch_dataLoop['GL_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            
                                                        }
                                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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