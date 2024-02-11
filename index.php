<?php 
    session_start(); 
    include('Includes/config.php');
    include('Includes/function.php');
?>
<?php include('Includes/head.php'); ?>
    <title>STUDENTS SUCCESS CONVENT SCHOOL - SARBAHDA GAYA, BIHAR</title>
    <meta name="keyword" content="students success convent, Sarbahda, ssconvent sarbahda, ssconvent sumit sir">
    <meta name="description" content="Students Success Convent is private school at Sarbahda, Gaya, Bihar. It Provides High Quality Education your students. These prepared of competitive exam Such as Sainik School, Netarhat School, NTSE, NLSTSE, INO, KVPY, etc. And prepares class play to 8th. Your Teacher is expert in this field">

    <meta name="author" content="Aalok20raj">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="Assets/Images/STUDENTS SUCCESS CONVENT LOGO Social Media Logo.jpg" sizes="16x16">
    <link rel="shortcut icon" type="image/png" href="Assets/Images/STUDENTS SUCCESS CONVENT LOGO Social Media Logo.jpg" sizes="16x16">
<?php 
include('Includes/header.php'); 
include('Includes/nav.php');
include('Includes/consoural.php');
?>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-2 pb-0 bg-danger text-center text-white ">
                <h4>Announcements</h4>
                <p>For You</p>
            </div>
            <div class="col-md-10 border border-danger p-0">
                <?php $announcement_fatch = mysqli_query($conn, "SELECT * FROM announcementslist WHERE AL_status='1' ORDER BY AL_id DESC");
                ?>
                <marquee behavior="" direction="left" class="mt-4">
                    <?php while($fetch_datainLoop = mysqli_fetch_array($announcement_fatch)) { ?>
                    <a href="viewannuncements.php?id=<?php echo $fetch_datainLoop['AL_id']; ?>" class="h3  text-decoration-none"><?php echo $fetch_datainLoop['AL_subject']; ?></a>
                <?php } ?>
                </marquee>
            </div>
        </div>
      </div>

      <div class="container-fluid pt-3">
        <h2 class="text-center text-bold pt-2 pb-3">About Us</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="Assets/Images/Student Success Convent.jpg" alt="" srcset="" width="100%" height="100%">
                </div>
                <div class="col-md-6"><br>
                    <h5>Welcome to</h5>
                    <h2>STUDENTS SUCCESS CONVENT, SARBAHDA, GAYA</h2>
                    <p>
                        Students Success Convent is a Private school in Sarbahda, Gaya, Bihar. It was founded in 2022 by Mr. Sumit Kumar. This school provide play to 5th class CBSC Pattern and 6th to 12th BSEB Pattern Education.
                    </p>
                    <p>
                        The school has an experienced and dedicated team of teachers who guide the students in their academic and personal growth. The school has a rich curriculum that provides students with knowledge and skills in a variety of subjects. The school has a modern infrastructure which includes well equipped classrooms, laboratories, library and playgrounds.
                    </p>
                    <p>
                        The school aims at providing students with a strong educational foundation that prepares them to be successful in their future careers. The school provides a high quality education which helps the students to develop not only academically but also personally and socially.
                    </p>
                    <p>The school provides opportunities to the students to participate in various extracurricular activities which foster their personal and social development. The school has an active annual calendar which includes various events and competitions.</p>
                </div>
            </div>
        </div>
      </div>

      <div class="container mt-4 pt-5">
        <div class="row">
            <div class="col-md-4 " >
                <div class="border border-danger border-2 p-4" style="height: 300px; border-radius: 10px;">
                    <p>Play to U.K.G grades</p>
                    <h1>Play School</h1>
                </div>
            </div>
            <div class="col-md-4 " >
                <div class="border border-danger border-2 p-4" style="height: 300px; border-radius: 10px;">
                    <p>1th to 5th grades</p>
                    <h1>Primary School</h1>
                </div>
            </div>
            <div class="col-md-4 " >
                <div class="border border-danger border-2 p-4" style="height: 300px; border-radius: 10px;">
                    <p>6th to 8th grades</p>
                    <h1>Middle School</h1>
                </div>
            </div>
        </div>
      </div>

      <div class="container mt-4 mb-4 pt-5 pb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    <img src="Assets/Images/Students Success Convent Principal.jpg" class="card-img-top" alt="..." height="350px">
                    <div class="card-body">
                      <h3 class="card-title text-center">Sumit Kumar</h3>
                      <p class="text-center" style="font-size: 12px;">Director & Principal</p>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <span class="d-flex justify-content-center">
                        <a href="#" class="border border-danger rounded-pill m-1 p-2 pt-1 pb-1 " target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube text-danger"></i></a>
                        <a href="#" class="border border-primary rounded-pill m-1 p-2 pt-1 pb-1 " target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="border border-danger-subtle rounded-pill m-1 p-2 pt-1 pb-1 " target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-square-instagram text-danger-emphasis"></i></a>
                        <a href="#" class="border border-danger rounded-pill m-1 p-2 pt-1 pb-1 " target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-pinterest text-danger"></i></a>
                        <a href="#" class="border border-success rounded-pill m-1 p-2 pt-1 pb-1 " target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp text-success"></i></a>
                      </span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-5">
                <h1>Director & Principal Message</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore neque saepe modi, harum quisquam aut ipsam fugiat corporis numquam asperiores deleniti molestiae, esse ipsa, ad cupiditate repellendus perferendis quis facere?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis laudantium, eaque dolor similique inventore sequi itaque officia deleniti voluptates doloribus aspernatur odit aliquam explicabo eligendi ipsam pariatur. Voluptatem, veritatis eum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A dicta recusandae quasi animi pariatur quis illo possimus quisquam accusantium debitis ab voluptates reprehenderit voluptate iste, temporibus autem deserunt error aperiam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis iure sint atque dolorum! Adipisci nesciunt, provident rem quas quae saepe debitis dolore eius odio reprehenderit quisquam ea asperiores, animi enim.</p>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-outline-danger" target="_blank" rel="noopener noreferrer"> Read More </a>
                </div>
            </div>
        </div>
      </div>
<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>
