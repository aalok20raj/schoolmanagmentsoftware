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
      if($type == 'et_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE exambyteacher SET et_status='$status' WHERE et_Id='$SHid'");
      }
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Exam Copy Check By Teacher Principal Dashboard - S S Convent Sarbahda</title>
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
                                            $Exam = get_safe_value($conn, $_POST['Examination']);
                                            $Teach = get_safe_value($conn,$_POST['Teacher']);
                                            $Clas = get_safe_value($conn,$_POST['Class']);
                                            $Subject = get_safe_value($conn,$_POST['Subject']);
                                            

                                                    $insertDate = mysqli_query($conn, "INSERT INTO exambyteacher(et_exam, et_teacher_type, et_class, et_subject)  VALUES('$Exam','$Teach','$Clas','$Subject')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Submit here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully Submit here.</div>";
                                                    }
                                                
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingExamination" name="Examination" aria-label="Floating label  select example" >
                                        <option selected>Select Examination</option>
                                        <?php $selectExam = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_status=1 ORDER BY ex_id DESC");
                                        while($fetchExamData = mysqli_fetch_array($selectExam)){
                                            ?>
                                            <option value="<?php echo $fetchExamData['ex_id']; ?>"><?php echo $fetchExamData['ex_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                      </select>
                                      <label for="floatingExamination">Select Examination</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingTeacher" name="Teacher" aria-label="Floating label  select example" >
                                        <option selected>Select Teacher</option>
                                        <?php $selectExam = mysqli_query($conn, "SELECT * FROM userlisting WHERE ul_role='Teacher' ORDER BY ul_id DESC");
                                        while($fetchExamData = mysqli_fetch_array($selectExam)){
                                            ?>
                                            <option value="<?php echo $fetchExamData['ul_id']; ?>"><?php echo $fetchExamData['ul_Name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                      </select>
                                      <label for="floatingTeacher">Select Teacher</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingClass" name="Class" aria-label="Floating label  select example" >
                                        <option selected>Select Class</option>
                                        <?php $selectExam = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_status=1 ORDER BY cl_id DESC");
                                        while($fetchExamData = mysqli_fetch_array($selectExam)){
                                            ?>
                                            <option value="<?php echo $fetchExamData['cl_id']; ?>"><?php echo $fetchExamData['cl_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                      </select>
                                      <label for="floatingClass">Select Class</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <select class="form-select" id="floatingSubject" name="Subject" aria-label="Floating label  select example" >
                                        <option selected>Select Subject</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="English">English</option>
                                        <option value="Math">Math</option>
                                        <option value="Science">Science</option>
                                        <option value="SST">SST</option>
                                        <option value="TP">TP</option>
                                        <option value="Computer">Computer</option>
                                        <option value="GK">GK</option>
                                        <option value="Sanksrit">Sanksrit</option>
                                        <option value="HWDEWD">HWD/EWD</option>
                                        <option value="Music">Music</option>
                                        <option value="Behaviour">Behaviour</option>

                                      </select>
                                      <label for="floatingSubject">Select Subject</label>
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
                                            <th>Exam Name</th>
                                            <th>Teacher</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $fetch_data = mysqli_query($conn,"SELECT * FROM exambyteacher ORDER BY et_Id DESC");
                                                while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php $eName = $fetch_dataLoop['et_exam']; 
                                                            $showExam = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_id='$eName'");
                                                            $showFeExam = mysqli_fetch_assoc($showExam);
                                                            echo $showFeExam['ex_name'];
                                                            ?>
                                                            </td>
                                                            <td><?php $eTeach= $fetch_dataLoop['et_teacher_type']; 
                                                            $showTeach = mysqli_query($conn, "SELECT * FROM userlisting WHERE ul_id='$eName'");
                                                            $showFeTeach = mysqli_fetch_assoc($showTeach);
                                                            echo $showFeTeach['ul_Name'];
                                                            ?>
                                                            </td>
                                                            <td><?php echo $fetch_dataLoop['et_class']; ?>
                                                            </td>
                                                            <td><?php echo $fetch_dataLoop['et_subject']; ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                  if ($fetch_dataLoop['et_status']==1) {
                                                                    echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=et_status&operation=deactive&id=".$fetch_dataLoop['et_Id']."'><i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                  }
                                                                  else{
                                                                    echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=et_status&operation=active&id=".$fetch_dataLoop['et_Id']."'><i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                  }
                                                                  ?>
                                                            </td>
                                                            <td>
                                                                <a href="EntryListModify.php?id=<?php echo $fetch_dataLoop['et_Id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                  
                                                                  <a href="deleteusers.php?id=<?php echo $fetch_dataLoop['et_Id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                  <a href="EntryListView.php?id=<?php echo $fetch_dataLoop['et_Id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    
                                                }
                                            ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>Teacher</th>
                                            <th>Class</th>
                                            <th>Subject</th>
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