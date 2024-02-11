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
      if($type == 'aci_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE admitcardlist SET aci_status='$status' WHERE acl_id='$SHid'");
      }
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admit Card List Principal Dashboard - S S Convent Sarbahda</title>
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
                                <div class="container-fluid bg-warning rounded-top text-center h2 p-3">Add Admit Card</div>
                                <?php 
                                if(isset($_POST['userSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $examtype = get_safe_value($conn,$_POST['examType']);
                                            $class = get_safe_value($conn,$_POST['classn']);
                                            $examDay = get_safe_value($conn,$_POST['day']);
                                            $examDate = get_safe_value($conn,$_POST['examDate']);
                                            $FirstSSub = get_safe_value($conn,$_POST['FirstSettingSub']);
                                            $FirstSTime = get_safe_value($conn,$_POST['FirstSettingSTime']);
                                            $FirstSSTime = get_safe_value($conn,$_POST['FirstSettingSSTime']);
                                            $FirstTime = $FirstSTime." to ".$FirstSSTime;
                                            $SecondSSub = get_safe_value($conn,$_POST['SecondSettingSub']);
                                            $SecondSTime = get_safe_value($conn,$_POST['SecondSettingTime']);
                                            $SecondSSTime = get_safe_value($conn,$_POST['SecondSettingSSTime']);
                                            $SecondTime = $SecondSTime." to ".$SecondSSTime;
                                            // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM admitcardlist WHERE acl_examType='$examtype' && acl_Class='$class' && acl_Day='$examDay' && acl_ExamiDate='$examDate'");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Examination Exit Here. Try Another Date of Exam. /div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO admitcardlist (acl_examType , acl_Class, acl_Day, acl_ExamiDate, acl_1stSettingSub, acl_1stSettingTime, acl_2ndSettingSub, acl_2ndSettingTime)  VALUES('$examtype','$class','$examDay','$examDate','$FirstSSub','$FirstTime','$SecondSSub','$SecondTime')");
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
                                            <option value="<?php echo $selectclass['ex_id']?>"><?php echo $selectclass['ex_name']?></option>
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
                                            <option value="<?php echo $selectclass['cl_id']?>"><?php echo $selectclass['cl_name']?></option>
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
                                        <option value="Mon">Mon</option>
                                        <option value="Tue">Tue</option>
                                        <option value="Wed">Wed</option>
                                        <option value="Thu">Thu</option>
                                        <option value="Fri">Fri</option>
                                        <option value="Sat">Sat</option>
                                        <option value="Sun">Sun</option>
                                      </select>
                                      <label for="floatingSelect">Examination Day</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="Date" class="form-control" name="examDate" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">Examination Date</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="FirstSettingSub" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">1st Setting Subject</label>
                                      
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="time" class="form-control" name="FirstSettingSTime" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">1st Setting Exam. Start Time</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="time" class="form-control" name="FirstSettingSSTime" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">1st Setting Exam. Exit Time</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="text" class="form-control" name="SecondSettingSub" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">2nd Setting Subject</label>
                                      
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="time" class="form-control" name="SecondSettingTime" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">2nd Setting Exam. Start Time</label>
                                    </div>
                                    <div class="form-floating mb-3 mt-3">
                                      <input type="time" class="form-control" name="SecondSettingSSTime" id="floatingName" placeholder="Full Name">
                                      <label for="floatingName">2nd Setting Exam. Exit Time</label>
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
                                            <th>Exam. Type</th>
                                            <th>Class</th>
                                            <th>Exam. Day</th>
                                            <th>Exam. Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                        $fetch_data = mysqli_query($conn,"SELECT * FROM admitcardlist ORDER BY acl_id DESC");
                                                        while ($fetch_dataLoop = mysqli_fetch_array($fetch_data)) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php $eid= $fetch_dataLoop['acl_examType'];
                                                                    $selectExam = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_id='$eid'");
                                                                    $displayexam = mysqli_fetch_assoc($selectExam);
                                                                    echo $displayexam['ex_name']; ?>
                                                                    </td>
                                                                    <td><?php $cid= $fetch_dataLoop['acl_Class']; 
                                                                    $selectClass = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_id='$cid'");
                                                                    $displayClass = mysqli_fetch_assoc($selectClass);
                                                                    echo $displayClass['cl_name'];?></td>
                                                                    <td><?php echo $fetch_dataLoop['acl_Day']; ?>
                                                                    </td>
                                                                    <td><?php echo $fetch_dataLoop['acl_ExamiDate']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php 
                                                                          if ($fetch_dataLoop['aci_status']==1) {
                                                                            echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=aci_status&operation=deactive&id=".$fetch_dataLoop['acl_id']."'>Active<i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                                                          }
                                                                          else{
                                                                            echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=aci_status&operation=active&id=".$fetch_dataLoop['acl_id']."'>Disactive<i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                                                          }
                                                                          ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="admitCardModify.php?id=<?php echo $fetch_dataLoop['acl_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                                                        <a href="admit_card.php?id=<?php echo $fetch_dataLoop['acl_id'];?>">| <i class="fa-solid fa-download"></i></a>
                                                                        
                                                                          <a href="deleteusers.php?id=<?php echo $fetch_dataLoop['acl_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                                                          
                                                                          <a href="view_student_profile.php?id=<?php echo $fetch_dataLoop['acl_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            
                                                        }
                                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Exam. Type</th>
                                            <th>Class</th>
                                            <th>Exam. Day</th>
                                            <th>Exam. Date</th>
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