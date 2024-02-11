<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM feelistclass ORDER BY FL_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['FL_regi'];
                $get_number = str_replace("SSCF", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 3, 0, STR_PAD_LEFT);
                $id = "SSCF".$get_string;
            }
        }
        else{
            $id ="SSCF001";
        }
    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'FL_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE feelistclass SET FL_status='$status' WHERE FL_id='$SHid'");
      }
    }
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
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Class Payment List</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $regi = $id;
                                            $class = get_safe_value($conn,$_POST['classn']);
                                            $service = get_safe_value($conn, $_POST['servicename']);
                                            $fee = get_safe_value($conn, $_POST['feeamount']);
                                            // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM feelistclass WHERE FL_class='$class' && FL_service_name = '$service'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Class name exit here. Try another name.</div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO feelistclass(FL_regi, FL_class, FL_service_name, FL_Fee)  VALUES('$regi','$class','$service','$fee')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Add Amount here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully add Amount here.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSelect" name="classn" aria-label="Floating label  select example" >
                                        <option selected>Select Class</option>
                                        <?php 
                                        $selectCla = mysqli_query($conn, "SELECT * FROM classlist ORDER BY cl_id DESC");
                                        while($selectclass = mysqli_fetch_array($selectCla)){
                                            if($selectclass['cl_status']==1){
                                            ?>
                                            <option value="<?php echo $selectclass['cl_id']?>"><?php echo $selectclass['cl_name']?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                      </select>
                                      <label for="floatingSelect">Class</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="servicename" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">Service Name</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="feeamount" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">Fee Amount</label>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">SUBMIT</button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Reg.no</th>
                                                <th>Service</th>
                                                <th>Class</th>
                                                <th>Fee</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Reg.no</th>
                                                <th>Service</th>
                                                <th>Class</th>
                                                <th>Fee</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                                $fetch_data = mysqli_query($conn,"SELECT * FROM feelistclass ORDER BY FL_regi DESC");
                                                while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $fetch_dataLoop['FL_regi']; ?>
                                                            </td>
                                                            <td><?php echo $fetch_dataLoop['FL_service_name']; ?>
                                                            </td>
                                                            <td><?php $class = $fetch_dataLoop['FL_class'];
                                                            $fetchc = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_id = '$class'");
                                                            $showclass = mysqli_fetch_assoc($fetchc);
                                                            echo $showclass['cl_name']; ?></td>
                                                            <td><?php echo $fetch_dataLoop['FL_Fee']; ?></a>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                  if ($fetch_dataLoop['FL_status']==1) {
                                                                    echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=FL_status&operation=deactive&id=".$fetch_dataLoop['FL_id']."'>Active<i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                  }
                                                                  else{
                                                                    echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=FL_status&operation=active&id=".$fetch_dataLoop['FL_id']."'>Disactive<i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                  }
                                                                  ?>
                                                            </td>
                                                            <td>
                                                                <a href="modifyStu_registration.php?id=<?php echo $fetch_dataLoop['FL_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                  <a href="Password_forget.php?id=<?php echo $fetch_dataLoop['FL_id'];?>">|<i class="fas fa-unlock-alt ml-2 mr-1"></i></a>
                                                                  <a href="deleteusers.php?id=<?php echo $fetch_dataLoop['FL_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                  <a href="view_student_profile.php?id=<?php echo $fetch_dataLoop['FL_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    
                                                }
                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<?php include('Includes/foot.php'); ?>