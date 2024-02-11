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
      if($type == 'ex_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE examlist SET ex_status='$status' WHERE ex_id='$SHid'");
      }
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Exam Type List Principal Dashboard - S S Convent Sarbahda</title>
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
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Add Examination</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $entryname = get_safe_value($conn, $_POST['Entrname']);
                                            $entrydate = get_safe_value($conn,$_POST['entryDate']);
                                            $examInst = get_safe_value($conn, $_POST['examInstruction']);
                                            $checkClass = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_name='$entryname'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Exam name exit here. Try another user.</div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO examlist(ex_name, ex_public_date,ex_inst)  VALUES('$entryname','$entrydate','$examInst')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Submit here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Submit here.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="Entrname" id="floatingEntryname" placeholder="Full Name">
                                      <label for="floatingEntryname">Name</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="date" class="form-control" name="entryDate" id="floatingEntryDate" placeholder="Full Name">
                                      <label for="floatingEntryDate">Entry Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <textarea class="form-control" placeholder="Leave a comment here" name="examInstruction" id="floatingTextarea"></textarea>
                                      <label for="floatingTextarea">Examination Instruction</label>
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
                                            <th>Name</th>
                                            <th>Public Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $fetch_data = mysqli_query($conn,"SELECT * FROM examlist ORDER BY ex_id DESC");
                                                while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $fetch_dataLoop['ex_name']; ?>
                                                            </td>
                                                            <td><?php echo $fetch_dataLoop['ex_public_date']; ?>
                                                            </td>
                                                            
                                                            <td>
                                                                <?php 
                                                                  if ($fetch_dataLoop['ex_status']==1) {
                                                                    echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=ex_status&operation=deactive&id=".$fetch_dataLoop['ex_id']."'><i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                  }
                                                                  else{
                                                                    echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=ex_status&operation=active&id=".$fetch_dataLoop['ex_id']."'><i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                  }
                                                                  ?>
                                                            </td>
                                                            <td>
                                                                <a href="Marks_sheet.php?id=<?php echo $fetch_dataLoop['ex_id'];?>"><i class="fa-solid fa-download"> </i></a>
                                                                <a href="ExamTypeListModify.php?id=<?php echo $fetch_dataLoop['ex_id'];?>">|<i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                  
                                                                  <a href="ExamTypeDelete.php?id=<?php echo $fetch_dataLoop['ex_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                  <a href="ExamTypeView.php?id=<?php echo $fetch_dataLoop['ex_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    
                                                }
                                            ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Public Date</th>
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