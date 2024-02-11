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

    $selectRegiNumber = mysqli_query($conn, "SELECT * FROM resultlist ORDER BY rl_id DESC LIMIT 1");
        if(mysqli_num_rows($selectRegiNumber)>0){
            if($row = mysqli_fetch_assoc($selectRegiNumber)){
                $regi = $row['rl_marksheetNo'];
                $get_number = str_replace("SSCMS", "", $regi);
                $id_increase = $get_number+1;
                $get_string = str_pad($id_increase, 6, 0, STR_PAD_LEFT);
                $id = "SSCMS".$get_string;
            }
        }
        else{
            $id ="SSCMS000001";
        }
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
                        <table width="100%">
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
                                $displayClass = mysqli_fetch_assoc($selecClass); echo $displayClass['cl_name']; $cls = $displayClass['cl_name']; ?></td>
                                <td colspan="1">Roll No - <b><?php echo $ShowClass['SCL_class']; ?></td>
                            </tr>
                        </table>
                        <?php 
                        if(isset($_POST['resultSubmit'])){
                            $marksheetno = $id;
                            $examtype = get_safe_value($conn,$_POST['examType']);
                            $regi = $ShowClass['SCL_id'];
                            $hindi = get_safe_value($conn,$_POST['Hindi']);
                            $English = get_safe_value($conn, $_POST['English']);
                            $Math = get_safe_value($conn, $_POST['Math']);
                            $Science = get_safe_value($conn, $_POST['Science']);
                            $SST = get_safe_value($conn, $_POST['SST']);
                            $Computer = get_safe_value($conn, $_POST['Computer']);
                            $GK = get_safe_value($conn, $_POST['GK']);
                            $Drawing = get_safe_value($conn, $_POST['Drawing']);
                            $obt = $hindi + $English + $Math + $Science + $SST + $Computer + $GK + $Drawing;
                            if($cls = 'Play' OR $cls = 'Nursery' OR $cls = 'LKG' OR $cls = 'UKG'){
                                $Tmarks = 320;
                            }else{
                                $Tmarks = 560;
                            }
                            $per = ($obt/$Tmarks)*100;
                            $perc = round($per,1);
                            if($perc >= 80){
                                $grade = "A";
                            }
                            else if($perc >= 60){
                                $grade = "B";
                            }
                            else if($perc >= 40){
                                $grade = "C";
                            }else{
                                $grade = "F";
                            }
                            if($perc >= 40){
                                $results = "Pass";
                            }else{
                                $results = "Fail";
                            }
                            
                            $checkcondition = mysqli_query($conn, "SELECT * FROM resultlist WHERE rl_ExamType='$examtype' AND rl_StuRegi='$regi'");
                            $countcheckcondtion = mysqli_num_rows($checkcondition);
                            if($countcheckcondtion == 1){
                                $_SESSION['status'] = "<div class='alert alert-warning'><strong>Hii </strong>This Student result all read insert. try another student.</div>";
                            }else{
                                $insertDate = mysqli_query($conn, "INSERT INTO resultlist(rl_marksheetNo, rl_ExamType, rl_StuRegi, rl_hindi, rl_engi, rl_math, rl_Sci, rl_sst, rl_com, rl_gk, rl_Drawing, rl_obtMark, rl_per, rl_grade, rl_result)  VALUES('$marksheetno','$examtype','$regi','$hindi','$English','$Math','$Science','$SST','$Computer','$GK','$Drawing','$obt','$perc','$grade','$results')");
                                if($insertDate){
                                    $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have Successfully Add Class here.</div>";
                                }
                                else{
                                    $_SESSION['status'] = "<div class='alert alert-success'><strong>Hey! </strong>You have not successfully add class here.</div>";
                                }
                            }
                            }
                        ?>
                        <form method="POST" >
                            <table width="100%">
                                <tr>
                                    <td>Choose Exam Type</td>
                                    <td colspan="3">
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
                                    <td></td>
                                    <td>Total Marks</td>
                                    <td>Passing Marks</td>
                                    <td>Obt. Marks</td>
                                </tr>
                                <tr>
                                    <td>Hindi</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()"  min="0" max="80" name="Hindi"></td>
                                </tr>
                                <tr>
                                    <td>English</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="English"></td>
                                </tr>
                                <tr>
                                    <td>Math</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="Math"></td>
                                </tr>
                                <tr>
                                    <td>SST/ EVS</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="SST"></td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="GK"></td>
                                </tr>
                                <tr>
                                    <td>Computer</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="Computer"></td>
                                </tr>
                                <tr>
                                    <td>Science</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="Science"></td>
                                </tr>
                                <tr>
                                    <td>Drawing</td>
                                    <td>80</td>
                                    <td>25</td>
                                    <td><input type="number" class="sumsubject" onblur="findTotal()" onclick="runcheck()" min="0" max="80" name="Drawing"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        Total Obt. Marks
                                    </td>
                                    <td>
                                        <input type="number" name="totalobtmark" id="totalordercost" readonly/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        Percentage
                                    </td>
                                    <td>
                                        <input type="number" name="percentages" id="percentage" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right" >
                                        Greade
                                    </td>
                                    <td>
                                        <input type="text" name="grades" id="grades" readonly/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        Result
                                    </td>
                                    <td>
                                        <input type="text" name="result" id="res" readonly/>
                                    </td>
                                </tr>             
                            </table>
                            <div class="d-flex justify-content-end">
                                <button class=" btn btn-outline-primary mt-3" name="resultSubmit">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </main>
                <?php include('Includes/footer.php'); ?>
            </div>
        </div>
<?php include ('Includes/script.php');?>
<script>
    
    function findTotal(){ onclick="runcheck()"
    var arr = document.getElementsByClassName('sumsubject');
    var tot=0;
    var totalmark = 0;
    let classs = '<?php echo $cls; ?>';
    if(classs = 'Play'){
        totalmark = 320;
    }else if(classs = 'Nursery'){
        totalmark = 320;
    }
    else if(classs = 'LKG'){
        totalmark = 320;
    }
    else if(classs = 'UKG'){
        totalmark = 320;
    }
    else{
        totalmark = 560;
    }
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('totalordercost').value = tot;
    var percentage = (tot/totalmark)*100;
    document.getElementById('percentage').value = percentage.toFixed(0);

    // grade 
    let grades = ""; 
    if (percentage <= 100 && percentage >= 80) { 
        grades = "A"; 
    } else if (percentage <= 79 && percentage >= 60) { 
        grades = "B"; 
    } else if (percentage <= 59 && percentage >= 40) { 
        grades = "C"; 
    } else { 
        grades = "F"; 
    } 
    document.getElementById('grades').value = grades;

    // result 
    var result = "";
    if(percentage>=40){
        result = "Pass";
    }
    else{
        result="Fail";
    }
    document.getElementById('res').value = result;
    }

    function runcheck(){
        var inputvalue = document.getElementsByClassName('sumsubject').value;
        if(inputvalue>=80){
            alert("Input under 80 Marks.");
        }
    }
    
</script>
<?php include('Includes/foot.php'); ?>