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
    $SelectResult = mysqli_query($conn, "SELECT * FROM resultlist WHERE rl_id ='$entry_id'");
    $DisplayResult = mysqli_fetch_assoc($SelectResult);

    $stuid = $DisplayResult['rl_StuRegi'];
    $selectEntry = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_id ='$stuid'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);
?>
<?php 
    include('Includes/head.php'); 
?>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Examination Marks Enter Here - Prinical Dashboard Students Success Convent</title>
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
                            <a href="ExamResultList.php" class="btn btn-outline-danger rounded-pill btn-sm"><i class="bi bi-skip-backward font-weight-bold"></i> Back</a>
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <a href="StudentRegistration.php" class="btn btn-outline-primary rounded-pill btn-sm"><i class="bi bi-plus-circle-fill"></i> Add</a>
                          </div>
                        </div>
                        <style type="text/css">
                            table{
                                width: 50vw;
                                margin: auto;
                            }
                            table, tr,  td{
                                border: 1px solid black;
                                padding: 5px;
                            }
                        </style>
                            <?php 
                                $suId = $DisplayEntry['sl_id'];
                                $fatchClass = mysqli_query($conn, "SELECT * FROM studentclasslist WHERE SCL_stuID ='$suId' ORDER BY SCL_id DESC LIMIT 1");
                                $ShowClass = mysqli_fetch_assoc($fatchClass); 
                            ?>
                        <table>
                            <tr>
                                <td colspan="3">
                                    <h2 class="text-center">Enter Student Marks</h2>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" width="80%">
                                    Registration No. 
                                </td>
                                <td rowspan="4" width="20%">
                                    <img class="d-flex align-content-center" src="<?php echo "../Assets/StudentsPhoto/".$DisplayEntry['sl_photo']; ?>" width="150vw" alt="Image">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b><?php echo $DisplayEntry['sl_regi']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Registration Session
                                </td>
                            </tr><tr>
                                <td colspan="2">
                                    <b><?php echo $ShowClass['SCL_session']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%" colspan="1">Name</td>
                                <td width="70%" colspan="2"> <b><?php echo $DisplayEntry['sl_name']; ?></b></td>
                            </tr>
                            <tr>
                                <td width="30%" colspan="1">Father's Name</td>
                                <td width="70%" colspan="2"> <b><?php echo $DisplayEntry['sl_fatherName']; ?></b></td>
                            </tr>
                            <tr>
                                <td width="30%" colspan="1">Mother's Name</td>
                                <td width="70%" colspan="2"> <b><?php echo $DisplayEntry['sl_motherName']; ?></b></td>
                            </tr>
                            <tr>
                                
                                <td colspan="1">Session - <b><?php echo $ShowClass['SCL_session']; ?></td>
                                <td colspan="1">Class - <b><?php 

                                $cid = $ShowClass['SCL_class'];

                                $selecClass = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_id='$cid'");
                                $showClass = mysqli_fetch_assoc($selecClass); echo $showClass['cl_name']; ?></td>
                                <td colspan="1">Roll No - <b><?php echo $ShowClass['SCL_class']; ?></td>
                            </tr>
                        </table>
                        <?php 
                                if(isset($_POST['resultSubmit'])){
                                    if (isset($_POST['g-recaptcha-response'])) {
                                    $secretAPIkey = '6LdPV30dAAAAAMg5cfConsF6Q1RfNYnHGZWwzB38';
                                    // reCAPTCHA response verification
                                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
                                    // Decode JSON data
                                    $response = json_decode($verifyResponse);
                                        if($response->success){
                                            $sesion = "2022-2024";
                                            $examtype = get_safe_value($conn,$_POST['examType']);
                                            $regi = $DisplayEntry['sl_id'];
                                            $hindi = get_safe_value($conn,$_POST['Hindi']);
                                            $English = get_safe_value($conn, $_POST['English']);
                                            $Math = get_safe_value($conn, $_POST['Math']);
                                            $Science = get_safe_value($conn, $_POST['Science']);
                                            $SST = get_safe_value($conn, $_POST['SST']);
                                            $TP = get_safe_value($conn, $_POST['TP']);
                                            $Computer = get_safe_value($conn, $_POST['Computer']);
                                            $GK = get_safe_value($conn, $_POST['GK']);
                                            $Sanskrit = get_safe_value($conn, $_POST['Sanskrit']);
                                            $HWDEWD = get_safe_value($conn, $_POST['HWDEWD']);
                                            $Music = get_safe_value($conn, $_POST['Music']);
                                            $Behi = get_safe_value($conn, $_POST['Behi']);
                                            $sum = $hindi + $English + $Math + $Science + $SST + $TP + $Computer + $GK + $Sanskrit + $HWDEWD + $Music + $Behi;

                                            // do check mobile 
                                            $checkClass = mysqli_query($conn, "SELECT * FROM resultlist WHERE rl_session='$sesion' && rl_resultType = '$examtype' && rl_StuRegi = '$regi' ");
                                            $CountCheckClass = mysqli_num_rows($checkClass);
                                            if($CountCheckClass == 1){
                                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Student Result Exit Here. Try Other Exam. Type.</div>";
                                            }
                                            
                                                else{

                                                    $insertDate = mysqli_query($conn, "INSERT INTO resultlist(rl_session, rl_resultType, rl_StuRegi, rl_hindi, rl_engi, rl_math, rl_sci, rl_sst, rl_tp, rl_com, rl_gk, rl_snkUrdu, rl_hwdEwd, rl_music, rl_behi, rl_obtMark)  VALUES('$sesion','$examtype','$regi','$hindi','$English','$Math','$Science','$SST','$TP','$Computer','$GK','$Sanskrit','$HWDEWD','$Music','$Behi','$sum')");
                                                    if($insertDate){
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Add Amount here.</div>";
                                                    }
                                                    else{
                                                        $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully add Amount here.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                        <form method="POST">
                            <table>
                                <tr>
                                    <td>Choose Exam Type</td>
                                    <td>
                                        <select name="examType">
                                            <?php 
                                                $examTypeS = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_status=1 ");
                                                while($examTF = mysqli_fetch_array($examTypeS)){
                                                    ?>
                                                    <option value="<?php echo $examTF['ex_id']; ?>"><?php echo $examTF['ex_name']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hindi</td>
                                    <td><input type="text" name="Hindi"></td>
                                </tr>
                                <tr>
                                    <td>English</td>
                                    <td><input type="text" name="English"></td>
                                </tr>
                                <tr>
                                    <td>Math</td>
                                    <td><input type="text" name="Math"></td>
                                </tr>
                                <tr>
                                    <td>Science</td>
                                    <td><input type="text" name="Science"></td>
                                </tr>
                                <tr>
                                    <td>SST</td>
                                    <td><input type="text" name="SST"></td>
                                </tr>
                                <tr>
                                    <td>TP</td>
                                    <td><input type="text" name="TP"></td>
                                </tr>
                                <tr>
                                    <td>Computer</td>
                                    <td><input type="text" name="Computer"></td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td><input type="text" name="GK"></td>
                                </tr>
                                <tr>
                                    <td>Sanskrit</td>
                                    <td><input type="text" name="Sanskrit"></td>
                                </tr>
                                <tr>
                                    <td>HWDEWD</td>
                                    <td><input type="text" name="HWDEWD"></td>
                                </tr>
                                <tr>
                                    <td>Music</td>
                                    <td><input type="text" name="Music"></td>
                                </tr>
                                <tr>
                                    <td>Behi.</td>
                                    <td><input type="text" name="Behi"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button class=" btn btn-outline-primary" name="resultSubmit">SUBMIT</button></td>
                                </tr>

                            </table>
                        </form>
                    </div>
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<?php include('Includes/foot.php'); ?>