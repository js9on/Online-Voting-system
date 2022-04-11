<?php
$page_tittle ="index Page";

include('includes/header.php');
include('includes/navbar.php');
 ?>


  <section id="hero" class="d-flex align-items-center" >

<div class="container">
  <div class="row">
    <div class="col-lg-6 d-flex flex-column justify-content-center pt-1 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
    
      <img src="img/citys.png" alt="ciyuniversity logo" style="width:65%; margin: 0 auto 15px auto; ;">
      <h1 class="text-center">City University Online Voting System</h1>
      <h2 class="text-center">A voting system that can be used to help students to easily determine the opinion of public on some issue</h2>
      <div class="d-flex justify-content-center ">
        <a href="register.php" class="btn-get-started scrollto">Get Started</a>
        <a href="" class="btn-get-started scrollto">Learn More</a>
      </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 votes align-center" data-aos="zoom-in" data-aos-delay="200">
      <img src="img/votes.png" class="img-fluid animated" alt="">
    </div>
  </div>
</div>

</section><!-- End Hero -->

<section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6 ">
            <p>
            Votes is a voting system that can be used to help students to easily determine the opinion of a group or the public on some issue.
            </p>
            <ul>
              <li><i class="fa fa-check"></i> Real-time results</li>
              <li><i class="fa fa-check"></i> Community or private poll</li>
              <li><i class="fa fa-check"></i> Avoidance of duplicate voting</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 ">
            <p>
            the voting system is very useful for students in City University during the midst of the pandemic which causes 
            both lecturers and students to study at home. therefore, the system is effective when the 
            majority opinion is important and not the opinion of each individual participant. 
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->





<section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title mb-5">
          <h2>Features</h2>
          <br>
          <p>the Votes voting system provides effective and authentic results through satisfied features along with the convenience of voting functions</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Simplicity</a></h4>
              <p>Users are able to navigate and cast their votes with ease through our UI</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Dashboard</a></h4>
              <p>Manage all your polls in a single place by using your account dashboard.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Secure environment</a></h4>
              <p>Provide authentic results with secure encryption and a multitude of security functions</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Free and accesible</a></h4>
              <p>Its free and easy to access through multiple platforms</p>
            </div>
          </div>

        </div>

      </div>
    </section>






<?php include('includes/footer.php');?>
