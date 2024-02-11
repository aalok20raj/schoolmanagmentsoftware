<?php
    session_start(); 
    include('../Includes/config_dataBase.php');
    include('../../Includes/function.php');
    if (!isset($_SESSION['ul_email'])) {
     header('location:../../index.php');
    }
    //Data Fetch query  
    $entry_id = mysqli_real_escape_string($conn,$_GET['id']);
    $selectEntry = mysqli_query($conn, "SELECT * FROM studentlist WHERE sl_id ='$entry_id'");
    $DisplayEntry = mysqli_fetch_assoc($selectEntry);

    $stuclass = $DisplayEntry['sl_id'];
    $selectstuclass = mysqli_query($conn, "SELECT * FROM studentclasslist WHERE SCL_stuID ='$stuclass'");
    $DisplayStuClass = mysqli_fetch_assoc($selectstuclass);

    $sturesult = $DisplayStuClass['SCL_id'];
    $selectresult = mysqli_query($conn, "SELECT * FROM resultlist WHERE rl_StuRegi ='$sturesult'");
    $DisplayResult = mysqli_fetch_assoc($selectresult);

    $selectExam = mysqli_query($conn, "SELECT * FROM examlist WHERE ex_id ='1'");
    $DisplayExam = mysqli_fetch_assoc($selectExam);
?>
<?php 
    include('Includes/head.php'); 
?>
<meta name="description" content="" />
<meta name="author" content="" />
<title>Principal Dashboard - Students Success Convent, Sarbahda, Gaya</title> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<style>
    *,*::before,*::after {
    box-sizing: border-box;
    }
    .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 5px;
    margin-button: 10px !important;
    margin-left: 23px;
    }
    #certificate{
    width: 100%;
    }
    .justify-content-center {
    justify-content: center !important;
    }
    .set-border{
        width: 100%;
        background: url("http://localhost/S%20S%20Convent%20School/Assets/Images/result.jpg");
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center;
        padding-bottom:50px;
    }
    .text-center{
        padding-top: 70px;
        text-align:center;
        font-fmaily: arial;
    }
    .set-border .marksheet{
        text-align: right;
        margin-right: 25%;
    }
    .info tr td{
        border: 1px solid black;
        padding: 10px;
    }
    table{
        margin: auto;
        width: 70%;
    }
    .infomark{
        margin-top: 30px;
        margin-button : 90px;
    }
    .infomark tr td, th{
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }



</style>  
</head>
    <button onclick="print()" class="button">Download Marksheet</button>
    <section id="certificate">
        <div class="set-border">
            <div class="text-center">
                <img class="logo" src="http://localhost/S%20S%20Convent%20School/Assets/Images/ssconventLogo.png" alt="">
                <h2><?php echo $DisplayExam['ex_name']; ?></h2>
                <h3>MARKSHEET</h3>
            </div>
            <p class="marksheet">Marksheet No: <b><?php echo $DisplayResult['rl_marksheetNo']; ?></b></p>
            <table cellspacing="0" class="info">
                <tr>
                    <td colspan="2" width="30%">Registration No.</td>
                    <td colspan="2" width="40%"><b><?php echo $DisplayEntry['sl_regi']; ?></b></td>
                    <td colspan="2" rowspan="5" width="30%" style="text-align: center;"><img src="<?php echo "../Assets/StudentsPhoto/".$DisplayEntry['sl_photo']; ?>" width="180vw" alt="Image"></td>
                </tr>
                <tr>
                    <td colspan="2">Registration Session</td>
                    <td colspan="2"><b><?php echo $DisplayStuClass['SCL_session'];?></b></td>
                </tr>
                <tr>
                    <td colspan="2">Student Name</td>
                    <td colspan="2"><b><?php echo $DisplayEntry['sl_name']; ?></b></td>
                </tr>
                <tr>
                    <td colspan="2">Father's Name</td>
                    <td colspan="2"><b><?php echo $DisplayEntry['sl_fatherName']; ?></b></td>
                </tr>
                <tr>
                    <td colspan="2">Mother's Name</td>
                    <td colspan="2"><b><?php echo $DisplayEntry['sl_motherName']; ?></b></td>
                </tr>
                <tr>
                    <td>Class</td>
                    <td><b><?php $cla = $DisplayStuClass['SCL_class'];
                        $selectclass = mysqli_query($conn, "SELECT * FROM classlist WHERE cl_id='$cla' ");
                        $Displayclass = mysqli_fetch_assoc($selectclass);
                        echo $Displayclass['cl_name'];
                        ?></b></td>
                    <td>Roll No.</td>
                    <td><b><?php echo $DisplayStuClass['SCL_rollno'];?></b></td>
                    <td>Section</td>
                    <td><b><?php echo $DisplayStuClass['SCL_rollno'];?></b></td>
                </tr>
            </table>
            <table cellspacing="0" class="infomark">
                <tr>
                    <th>Subject Name</th>
                    <th>Full Marks</th>
                    <th>Passing Marks</th>
                    <th>Obt. Marks</th>
                </tr>
                <tr>
                    <th>HINDI</th>
                    <th>80</th>
                    <th>32</th>
                    <th><?php echo $DisplayResult['rl_hindi']; ?></th>
                </tr>
                <tr>
                    <th>ENGLISH</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
                <tr>
                    <th>MATH</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
                <tr>
                    <th>DRAWING</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
                <tr>
                    <th>E.V.S/ S.S.T</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
                <tr>
                    <th>COMPUTER</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
                <tr>
                    <th>SCIENCE</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
                <tr>
                    <th>GK</th>
                    <th>80</th>
                    <th>32</th>
                    <th></th>
                </tr>
            </table>
            <table cellspacing="0" class="">
                <tr>
                    <td>Total Obt. Marks</td>
                    <td><b></b></td>
                    <td>Per.</td>
                    <td><b></b></td>
                    <td>Grade</td>
                    <td><b></b></td>
                    <td>Result</td>
                    <td><b></b></td>
                </tr>
            </table>
        </div>
    </section>
    <script>
    function print() 
    {
    // body...
    const certificate = this.document.getElementById("certificate");
    var opt = {
    margin: 0.00,
    filename: 'marksheet_ST4520621097',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait', }
    };
    html2pdf().from(certificate).set(opt).save();
    }   
    </script>
<?php include('Includes/foot.php'); ?>