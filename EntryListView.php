<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
?>
<?php
    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM enquirydatalist ORDER BY El_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['El_Regi_no'];
                $get_number = str_replace("SSCE", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 3, 0, STR_PAD_LEFT);
                $id = "SSCE".$get_string;
            }
        }
        else{
            $id ="SSCE001";
        }
    // Public and Hide Post 
    if (isset($_GET['type']) && $_GET['type']!='') {
      $type = get_safe_value($conn, $_GET['type']);
      if($type == 'El_status'){
        $operation = get_safe_value($conn,$_GET['operation']);
        $SHid = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
          $status = '1';
        }else{
          $status = '0';
        }
        $update_public = mysqli_query($conn, "UPDATE enquirydatalist SET El_status='$status' WHERE El_id='$SHid'");
      }
    }
    //Data Fetch query  
    $entry_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectEntry = mysqli_query($conn, "SELECT * FROM enquirydatalist WHERE El_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
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
                                <a href="EntryListModify.php?id=<?php echo $DisplayEntry['El_id'];?>" class="btn btn-sm btn-outline-danger rounded-pill">Upgrade</a>
                            </div>
                        </div>
                        <style type="text/css">
                            table, tr, td{
                                padding: 10px;
                                border: 1px solid black;
                            }
                        </style>
                        <div class="row">
                            <table cellspacing="0" width="90%">
                                <tr>
                                    <td>Entry No. </td>
                                    <td><?php echo $DisplayEntry['El_Regi_no'];?></td>
                                    <td>Entry Regi. Date</td>
                                    <td><?php echo $DisplayEntry['El_Date'];?></td>
                                    <td>Upgrade Date/ Time</td>
                                    <td><?php echo $DisplayEntry['El_upgradedate'];?></td>

                                </tr>
                                <tr>
                                    <td>Contact Name</td>
                                    <td><?php echo $DisplayEntry['El_Name'];?></td>
                                    <td>Mobile</td>
                                    <td><?php echo $DisplayEntry['El_mobile'];?></td>
                                    <td>Whatsapp No</td>
                                    <td><?php echo $DisplayEntry['El_whatsappNo'];?></td>
                                </tr>
                                <tr>
                                    <td>Next Meet Date</td>
                                    <td><b class="text-danger"><?php echo $DisplayEntry['El_meetDate'];?></b></td>
                                    <td rowspan="2">Message</td>
                                    <td ><?php echo $DisplayEntry['El_message'];?></td>
                                </tr>

                            </table>
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