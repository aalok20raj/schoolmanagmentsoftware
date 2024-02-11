<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM userlisting ORDER BY ul_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['ul_Reg'];
                $get_number = str_replace("SSC", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 3, 0, STR_PAD_LEFT);
                $id = "SSC".$get_string;
            }
        }
        else{
            $id ="SSC001";
        }

    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'ul_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE userlisting SET ul_status='$status' WHERE ul_id='$SHid'");
      }
    }
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
                                <a href="" class="btn btn-sm btn-outline-danger rounded-pill">Add</a>
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
                                            $name = get_safe_value($conn,$_POST['name']);
                                            $mobile = get_safe_value($conn, $_POST['mobile']);
                                            $email = get_safe_value($conn, $_POST['email']);
                                            $user = get_safe_value($conn, $_POST['usertype']);
                                            $password = get_safe_value($conn, $_POST['pass']);
                                            $cpassword = get_safe_value($conn, $_POST['cpass']);
                                            $pass = password_hash($password, PASSWORD_BCRYPT);
                                            // do check mobile 
                                            $domobile = mysqli_query($conn, "SELECT * FROM userlisting WHERE ul_mobile='$mobile'");
                                            $doCountMobile = mysqli_num_rows($domobile);
                                            if($doCountMobile == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong> This mobile exit here. Try another Mobile Number.</div>";
                                            }
                                            else{
                                                //do check email 
                                                $doemail = mysqli_query($conn, "SELECT * FROM userlisting WHERE ul_email = '$email'");
                                                $doCountEmail = mysqli_num_rows($doemail);
                                                if($doCountEmail == 1){
                                                    $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong> This Email Address exit here. Try another Email Address.</div>";
                                                }
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO userlisting(ul_Reg, ul_Name, ul_mobile, ul_email, ul_role, ul_password)  VALUES('$id','$name','$mobile','$email','$user','$pass')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Registration here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Registration here.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="name" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">Full Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="mobile" class="form-control" name="mobile" id="floatingMobile" placeholder="Mobile Number">
                                      <label for="floatingMobile">Mobile Number</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com">
                                      <label for="floatingEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="usertype" aria-label="Floating label  select example" >
                                        <option selected>Select user type</option>
                                        <option value="Principle">Principle</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Operator">Operator</option>
                                      </select>
                                      <label for="floatingSelect">Select user type</label>
                                    </div>
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
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">SUBMIT</button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>User Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php 
                                                $fetch_data = mysqli_query($conn,"SELECT * FROM userlisting ORDER BY ul_id DESC");
                                                while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                    ?>
                                                        <tr>
                                                            <td><img class="d-flex align-content-center" src="<?php echo "../Assets/StudentsPhoto/".$fetch_dataLoop['ul_photo']; ?>" width="50vw" alt="Image"></td>
                                                            <td><?php echo $fetch_dataLoop['ul_Name']; ?></td>
                                                            <td><?php echo $fetch_dataLoop['ul_role']; ?></td>
                                                            <td>
                                                                <?php 
                                                                  if ($fetch_dataLoop['ul_status']==1) {
                                                                    echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=ul_status&operation=deactive&id=".$fetch_dataLoop['ul_id']."'><i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                  }
                                                                  else{
                                                                    echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=ul_status&operation=active&id=".$fetch_dataLoop['ul_id']."'><i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                  }
                                                                  ?>
                                                            </td>
                                                            <td>
                                                                <a href="userUpgrade.php?id=<?php echo $fetch_dataLoop['ul_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                  <a href="userPasswordUpgrade.php?id=<?php echo $fetch_dataLoop['ul_id'];?>">|<i class="fas fa-unlock-alt ml-2 mr-1"></i></a>
                                                                  <a href="deleteusers.php?id=<?php echo $fetch_dataLoop['ul_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                  <a href="view_student_profile.php?id=<?php echo $fetch_dataLoop['ul_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    
                                                }
                                            ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>User Role</th>
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