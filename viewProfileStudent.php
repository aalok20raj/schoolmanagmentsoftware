<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    //Data Fetch query  
    $entry_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectEntry = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Student Profile View - Principal Dashboard Students Success Convent, Sarbahda, Gaya</title>
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
                            <a href="studentList.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="bi bi-skip-backward font-weight-bold"></i> Back</a>
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <a href="stuRegislip.php?id=<?php echo $DisplayEntry['sl_id'];?>" class="btn btn-outline-danger rounded-pill btn-sm m-1"><i class="bi bi-plus-circle-fill"></i> Download ID Card</a>
                            <a href="stuRegislip.php?id=<?php echo $DisplayEntry['sl_id'];?>" class="btn btn-outline-primary rounded-pill btn-sm m-1"><i class="bi bi-plus-circle-fill"></i> Download Registration Slip</a>
                          </div>
                        </div>
                        <style type="text/css">
                            table, tr, td{
                                border: 2px solid black;
                            }
                        </style>

                        <table width="100%" cellspacing="0" cellpadding="5">
                            <tr style="text-align: center;">
                                <td colspan="10">
                                    <h1>Students Success Convent</h1>
                                    <p>Sarbahda, Dih Road, Gaya</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Regi No</td>
                                <td><?php echo $DisplayEntry['sl_regi']; ?></td>
                                <td>Session</td>
                                <td>2023-2024</td>
                                <td>Regi. Date</td>
                                <td><?php echo $DisplayEntry['sl_regi_date']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php if($DisplayEntry['sl_status']==1){
                                    ?>
                                    <button type="button" class="btn btn-success">Active</button>
                                    <?php
                                    }else{
                                        ?>
                                        <button type="button" class="btn btn-danger">Dis-active</button>
                                        <?php
                                    }  ?></td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <h5>Student's Personal Information</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Student's Name
                                </td>
                                <td colspan="4">
                                    <?php echo $DisplayEntry['sl_name']; ?>
                                </td>
                                <td rowspan="4">
                                    <img class="d-flex align-content-center" src="<?php echo "../Assets/StudentsPhoto/".$DisplayEntry['sl_photo']; ?>" width="150vw" alt="Image">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Father's Name
                                </td>
                                <td colspan="4">
                                    <?php echo $DisplayEntry['sl_fatherName']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mother's Name
                                </td>
                                <td colspan="4">
                                    <?php echo $DisplayEntry['sl_motherName']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Guardian's Name
                                </td>
                                <td colspan="4">
                                    <?php echo $DisplayEntry['sl_gradName']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date of Birth 
                                </td>
                                <td>
                                    <?php echo $DisplayEntry['sl_dob']; ?>
                                </td>
                                <td>
                                    Gender
                                </td>
                                <td><?php echo $DisplayEntry['sl_gender']; ?></td>
                                <td>
                                    Category
                                </td>
                                <td><?php echo $DisplayEntry['sl_category']; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Previous Class
                                </td>
                                <td>
                                    IV
                                </td>
                                <td>
                                    Current Class
                                </td>
                                <td>V</td>
                                <td>
                                    Roll No/ Section
                                </td>
                                <td>1/ A</td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <h5>Contact Details</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mobile Number
                                </td>
                                <td>
                                    <?php echo $DisplayEntry['sl_contentNumber']; ?>
                                </td>
                                <td>
                                    A. Mobile Number
                                </td>
                                <td>
                                    <?php echo $DisplayEntry['sl_alternativeNumber']; ?>
                                </td>
                                <td>
                                    Email Address
                                </td>
                                <td>
                                    <?php echo $DisplayEntry['sl_emailAddress']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Whatsapp Number
                                </td>
                                <td>
                                    <?php echo $DisplayEntry['sl_whatsappNumber']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Current Address
                                </td>
                                <td colspan="5">
                                    <?php echo $DisplayEntry['sl_caddress']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Perment Address
                                </td>
                                <td colspan="5">
                                    <?php echo $DisplayEntry['sl_paddress']; ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<?php include('Includes/foot.php'); ?>