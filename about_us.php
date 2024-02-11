<?php 
    session_start(); 
    include('Includes/config.php');
    include('Includes/function.php');
?>
<?php include('Includes/head.php'); ?>
    <title>About Us - STUDENTS SUCCESS CONVENT SCHOOL SARBAHDA GAYA, BIHAR</title>
    <style type="text/css">
        .timeline {
  border-left: 1px solid hsl(0, 0%, 90%);
  position: relative;
  list-style: none;
}

.timeline .timeline-item {
  position: relative;
}

.timeline .timeline-item:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline .timeline-item:after {
  background-color: hsl(0, 0%, 90%);
  left: -38px;
  border-radius: 50%;
  height: 11px;
  width: 11px;
  content: "";
}
    </style>
<?php 
include('Includes/header.php'); 
include('Includes/nav.php');

?>
<div class="container-fluid p-5 bg-primary">
    <h1 class="text-center text-white">About Us</h1>
</div>
<div class="container pt-5 pb-5">
    <div class="row">
                <div class="col-md-6">
                    <img src="Assets/Images/Student Success Convent.jpg" alt="" srcset="" width="100%" height="100%">
                </div>
                <div class="col-md-6"><br>
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
                    <button class="btn btn-outline-danger float-right">Read More</button>
                </div>
            </div>
            <!-- Section: Timeline -->
<section class="py-5">
  <ul class="timeline">
    <li class="timeline-item mb-5">
      <h5 class="fw-bold">Our company starts its operations</h5>
      <p class="text-muted mb-2 fw-bold">11 March 2020</p>
      <p class="text-muted">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
        necessitatibus adipisci, ad alias, voluptate pariatur officia
        repellendus repellat inventore fugit perferendis totam dolor
        voluptas et corrupti distinctio maxime corporis optio?
      </p>
    </li>

    <li class="timeline-item mb-5">
      <h5 class="fw-bold">First customer</h5>
      <p class="text-muted mb-2 fw-bold">19 March 2020</p>
      <p class="text-muted">
        Quisque ornare dui nibh, sagittis egestas nisi luctus nec. Sed
        aliquet laoreet sapien, eget pulvinar lectus maximus vel.
        Phasellus suscipit porta mattis.
      </p>
    </li>

    <li class="timeline-item mb-5">
      <h5 class="fw-bold">Our team exceeds 10 people</h5>
      <p class="text-muted mb-2 fw-bold">24 June 2020</p>
      <p class="text-muted">
        Orci varius natoque penatibus et magnis dis parturient montes,
        nascetur ridiculus mus. Nulla ullamcorper arcu lacus, maximus
        facilisis erat pellentesque nec. Duis et dui maximus dui aliquam
        convallis. Quisque consectetur purus erat, et ullamcorper sapien
        tincidunt vitae.
      </p>
    </li>

    <li class="timeline-item mb-5">
      <h5 class="fw-bold">Earned the first million $!</h5>
      <p class="text-muted mb-2 fw-bold">15 October 2020</p>
      <p class="text-muted">
        Nulla ac tellus convallis, pulvinar nulla ac, fermentum diam. Sed
        et urna sit amet massa dapibus tristique non finibus ligula. Nam
        pharetra libero nibh, id feugiat tortor rhoncus vitae. Ut suscipit
        vulputate mattis.
      </p>
    </li>
  </ul>
</section>
<!-- Section: Timeline -->
</div>
<?php 
include('Includes/footer.php'); 
include('Includes/foot.php');
?>
