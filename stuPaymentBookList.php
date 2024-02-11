<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
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
                            <a href="index.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="fa-solid fa-backward"></i> Back</a>
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <a href="stuPaymentForm.php" class="btn btn-outline-primary rounded-pill btn-sm"><i class="fa-solid fa-square-plus"></i> Add</a>
                          </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                        <tbody>
                                      <?php 
                                      $selectSturegi = mysqli_query($conn, "SELECT * FROM paymentbillbooklate ORDER BY pBBl_id DESC");
                                      while($fetchRegiStu = mysqli_fetch_array($selectSturegi)){
                                      ?>
                                      <tr>
                                        <td>
                                          <img class="d-flex align-content-center" src="<?php echo "../Assets/StudentsPhoto/".$fetchRegiStu['pBBl_billNo']; ?>" width="50vw" alt="Image"></td>
                                        <td><?php echo $fetchRegiStu['pBBl_billNo']; ?></td>
                                        <td><?php echo $fetchRegiStu['pBBl_stu_regi']; ?></td>
                                        <td><?php echo $fetchRegiStu['pBBl_netamount']; ?></td>
                                        <td><?php echo $fetchRegiStu['pBBl_duesAmount'];?></td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-danger rounded-pill" href="stuClassList.php?id=<?php echo $fetchRegiStu['pBBl_id'];?>">
                                                Class
                                                <?php 
                                                    $classId = $fetchRegiStu['pBBl_id'];
                                                    $selectclass = mysqli_query($conn, "SELECT * FROM studentclasslist WHERE SCL_stuID ='$classId' ");
                                                    $CountClass = mysqli_num_rows($selectclass);
                                                    echo $CountClass;

                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                          <?php 
                                          if ($fetchRegiStu['pBBl_status']==1) {
                                            echo "<a class='btn-sm btn-success text-decoration-none text-center' href='?type=pBBl_status&operation=deactive&id=".$fetchRegiStu['pBBl_id']."'><i class='fas fa-eye ml-2 mr-1 text-white'></i></a>";
                                          }
                                          else{
                                            echo "<a class='btn-sm btn-warning text-decoration-none text-center' href='?type=pBBl_status&operation=active&id=".$fetchRegiStu['pBBl_id']."'><i class='fas fa-eye-slash ml-2 mr-1 text-dark'></i></a>";
                                          }
                                          ?>  
                                        </td>
                                        <td>
                                          <a href="studentRegiModify.php?id=<?php echo $fetchRegiStu['pBBl_id'];?>"><i class="fas fa-pencil-alt ml-2 mr-1"></i></a>
                                          <a href="stuPhototake.php?id=<?php echo $fetchRegiStu['pBBl_id'];?>">|<i class="fa-solid fa-image ml-2 mr-1"></i></a>
                                          <a href="stuRegislip.php?id=<?php echo $fetchRegiStu['pBBl_id'];?>">|<i class="fa-solid fa-download"> </i></a>
                                          <a href="deleteusers.php?id=<?php echo $fetchRegiStu['pBBl_id'];?>">|<i class="fas fa-trash-alt ml-2 mr-1 text-danger "></i></a>
                                          <a href="viewProfileStudent.php?id=<?php echo $fetchRegiStu['pBBl_id'];?>">|<i class="fas fa-eye ml-2 mr-1 text-dark "></i></a>
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