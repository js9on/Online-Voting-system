
<?php

$page_tittle ="Contact";
include('includes/header.php');
include('includes/navbar.php');
 ?>

<section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title ">
          <h2>Contact</h2>
          <p>Have any enquiries? We'd love to hear it from you</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>No 45, Jalan Dato Yusuf Shahbudin 24, Taman Sentosa klang, Selangor 41200</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>Json_chongmin@hotmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d996.0816428077705!2d101.46542461758501!3d3.0065348480980494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdacf024a39d6f%3A0x6a88efcb4e792b8!2s45%2C%20Jalan%20Dato%20Yusuf%20Shahbudin%2024%2C%20Taman%20Sentosa%2C%2041200%20Klang%2C%20Selangor!5e0!3m2!1sen!2smy!4v1634714870644!5m2!1sen!2smy"  frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>



<?php include("includes/footer.php");?>