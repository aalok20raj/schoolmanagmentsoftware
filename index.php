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
                        <div class="row row-cols-2 row-cols-md-4 g-2 mt-4">
                            <!-- Total Registration student -->
                          <div class="col mt-2 mb-2">
                            <div class="card h-100">
                              <div class="row g-0"> 
                                    <div class="col-md-4">
                                      <img src="../Assets/Gallery/icons8-user.gif" class="img-fluid rounded-start" alt="..." width="100%">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card-body">
                                        <?php 
                                            $totalstu = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id");
                                            $countTotalStu = mysqli_num_rows($totalstu);
                                        ?>
                                        <h3 class="card-title"><?php echo $countTotalStu+150; ?></h3>
                                        <p class="card-text"><small class="text-muted"><a href="studentList.php" class="text-decoration-none">Students</a></small></p>
                                      </div>
                                    </div>
                              </div>
                           </div>
                          </div>
                          <!-- Total Tacher -->
                          <div class="col mt-2 mb-2">
                            <div class="card h-100">
                              <div class="row g-0"> 
                                    <div class="col-md-4">
                                      <img src="../Assets/Gallery/Teacher.gif" class="img-fluid rounded-start" alt="..." width="100%">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card-body">
                                        <?php 
                                            $totalstu = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id");
                                            $countTotalStu = mysqli_num_rows($totalstu);
                                        ?>
                                        <h3 class="card-title"><?php echo $countTotalStu+28; ?></h3>
                                        <p class="card-text"><small class="text-muted"><a href="studentList.php" class="text-decoration-none">Teachers</a></small></p>
                                      </div>
                                    </div>
                              </div>
                           </div>
                          </div>
                          <div class="col mt-2 mb-2">
                            <div class="card h-100">
                              <div class="row g-0"> 
                                    <div class="col-md-4">
                                      <img src="../Assets/Gallery/icons8-money.gif" class="img-fluid rounded-start" alt="..." width="100%">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card-body">
                                        <?php 
                                            $totalstu = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id");
                                            $countTotalStu = mysqli_num_rows($totalstu);
                                        ?>
                                        <h3 class="card-title"><?php echo $countTotalStu+14995; ?></h3>
                                        <p class="card-text"><small class="text-muted"><a href="studentList.php" class="text-decoration-none">This Month</a></small></p>
                                      </div>
                                    </div>
                              </div>
                           </div>
                          </div>
                          <div class="col mt-2 mb-2">
                            <div class="card h-100">
                              <div class="row g-0"> 
                                    <div class="col-md-4">
                                      <img src="../Assets/Gallery/users.gif" class="img-fluid rounded-start" alt="..." width="100%">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card-body">
                                        <?php 
                                            $totalstu = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id");
                                            $countTotalStu = mysqli_num_rows($totalstu);
                                        ?>
                                        <h3 class="card-title"><?php echo $countTotalStu; ?></h3>
                                        <p class="card-text"><small class="text-muted"><a href="studentList.php" class="text-decoration-none">Active Complaints</a></small></p>
                                      </div>
                                    </div>
                              </div>
                           </div>
                          </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Student Present Status
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Fees Collection & Expenses
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
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