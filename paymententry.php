<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM studentlist ORDER BY sl_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['sl_regi'];
                $get_number = str_replace("SSCS", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
                $id = "SSCS".$get_string;
            }
        }
        else{
            $id ="SSCS0001";
        }
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Payment Entry Voucher - Prinical Dashboard Students Success Convent</title>
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
                            <a href="stuPaymentBookList.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="bi bi-skip-backward font-weight-bold"></i> Back</a>
                          </div>
                          
                        </div>
                        <table class="table">
                            <tr>
                                <td rowspan ="3" width="20%"></td>
                                <td>Registration No.<br> <b>SSC010101</b></td>
                                <td>Session<br> <b>SSC010101</b></td>
                            </tr>
                            <tr>
                                <td>Name <br> <b>ALOK RAJ</b></td>
                                <td>Father's Name <br> <b>MANNU PRASAD</b></td>
                            </tr>

                            <tr>
                                <td>Class <br> <b>III</b></td>
                                <td>Section/ Roll No <br> <b>01</b></td>
                            </tr>
                            <tr>
                                <td>Van Service <br> <b>Yes</b></td>
                                <td>Due Amount<br> <b>01</b></td>
                                <td>Advance Deposit<br> <b>01</b></td>
                            </tr>
                        </table>
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control" id="Invoiceno" placeholder="Invoice Number">
                                      <label for="Invoiceno">Invoice</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                      <input type="date" class="form-control" id="Invoiceno" placeholder="Invoice Number">
                                      <label for="Invoiceno">Date</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<?php include('Includes/foot.php'); ?>