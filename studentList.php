<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'sl_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE studentlist SET sl_status='$status' WHERE sl_id='$SHid'");
      }
    }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Principal Dashboard - Students Success Convent, Sarbahda, Gaya</title>
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
                        <div class="row mb-3 mt-3">
                          <div class="col-md-6">
                            <a href="index.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="bi bi-skip-backward font-weight-bold"></i> Back</a>
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <a href="studentReg.php" class="btn btn-outline-primary rounded-pill btn-sm"><i class="bi bi-plus-circle-fill"></i> Add</a>
                          </div>
                        </div>
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Regi.No</th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>DOB</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                      $selectSturegi = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id DESC");
                                      while($fetchRegiStu = mysqli_fetch_array($selectSturegi)){
                                      ?>
                                      <tr>
                                        <td>
                                          <img class="d-flex align-content-center" src="<?php echo "../Assets/StudentsPhoto/".$fetchRegiStu['sl_photo']; ?>" width="50vw" alt="Image"></td>
                                        <td><?php echo $fetchRegiStu['sl_regi']; ?></td>
                                        <td><?php echo $fetchRegiStu['sl_name']; ?></td>
                                        <td><?php echo $fetchRegiStu['sl_fatherName']; ?></td>
                                        <td><?php echo date('d-M-Y', strtotime($fetchRegiStu['sl_dob']));?></td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-danger rounded-pill" href="stuClassList.php?id=<?php echo $fetchRegiStu['sl_id'];?>">
                                                Class
                                                <?php 
                                                    $classId = $fetchRegiStu['sl_id'];
                                                    $selectclass = mysqli_query($conn, "SELECT * FROM studentclasslist WHERE SCL_stuID ='$classId' ");
                                                    $CountClass = mysqli_num_rows($selectclass);
                                                    echo $CountClass;

                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                          <?php 
                                          if ($fetchRegiStu['sl_status']==1) {
                                            echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=sl_status&operation=deactive&id=".$fetchRegiStu['sl_id']."'><i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                          }
                                          else{
                                            echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=sl_status&operation=active&id=".$fetchRegiStu['sl_id']."'><i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                          }
                                          ?>  
                                        </td>
                                        <td>
                                          <a href="studentRegiModify.php?id=<?php echo $fetchRegiStu['sl_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                          <a href="stuPhototake.php?id=<?php echo $fetchRegiStu['sl_id'];?>">|<i class="fa-solid fa-image ml-2 mr-1"></i></a>
                                          <a href="stuRegislip.php?id=<?php echo $fetchRegiStu['sl_id'];?>">|<i class="fa-solid fa-download"> </i></a>
                                          <a href="deleteusers.php?id=<?php echo $fetchRegiStu['sl_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                          <a href="viewProfileStudent.php?id=<?php echo $fetchRegiStu['sl_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
                                        </td>
                                      </tr>
                                      <?php 
                                        }
                                      ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Photo</th>
                                    <th>Regi.No</th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>DOB</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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