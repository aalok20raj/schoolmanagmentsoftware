<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM classlist ORDER BY cl_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['cl_number'];
                $get_number = str_replace("SSCC", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 3, 0, STR_PAD_LEFT);
                $id = "SSCC".$get_string;
            }
        }
        else{
            $id ="SSCC001";
        }
    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'cl_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE classlist SET cl_status='$status' WHERE cl_id='$SHid'");
      }
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Class List Principal Dashboard - S S Convent Sarbahda</title>
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
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Add Class</div>
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
                                            // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_name='$name'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Class name exit here. Try another name.</div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO classlist(cl_number, cl_name)  VALUES('$id','$name')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Add Class here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully add class here.</div>";
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
                                    <div class="mb-2 d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdPV30dAAAAAImmoNduo4mYEDpBFYPxa7eSNYHl"></div>
                                    </div>
                                    <button class="btn btn-outline-warning rounded-pill w-100 text-dark" type="submit" name="userSubmit">SUBMIT</button>
                                </form>
                            </div>
                            
                            <div class="col-md-8">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Reg. No</th>
                                            <th>Class</th>
                                            <th>Fee</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                        $fetch_data = mysqli_query($conn,"SELECT * FROM classlist ORDER BY cl_number DESC");
                                                        while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $fetch_dataLoop['cl_number']; ?>
                                                                    </td>
                                                                    <td><?php echo $fetch_dataLoop['cl_name']; ?></td>
                                                                    <td><a href="classPaymentList.php?id=<?php echo $fetch_dataLoop['cl_id'];?>" class="btn btn-sm btn-outline-danger rounded-pill">Fee List</a>
                                                                    </td>
                                                                    <td>
                                                                        <?php 
                                                                          if ($fetch_dataLoop['cl_status']==1) {
                                                                            echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=cl_status&operation=deactive&id=".$fetch_dataLoop['cl_id']."'>Active<i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                          }
                                                                          else{
                                                                            echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=cl_status&operation=active&id=".$fetch_dataLoop['cl_id']."'>Disactive<i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                          }
                                                                          ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="modityclassList.php?id=<?php echo $fetch_dataLoop['cl_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                          <a href="Password_forget.php?id=<?php echo $fetch_dataLoop['cl_id'];?>">|<i class="fas fa-unlock-alt ml-2 mr-1"></i></a>
                                                                          <a href="deleteusers.php?id=<?php echo $fetch_dataLoop['cl_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                          <a href="view_student_profile.php?id=<?php echo $fetch_dataLoop['cl_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            
                                                        }
                                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Reg. No</th>
                                            <th>Class</th>
                                            <th>Fee</th>
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