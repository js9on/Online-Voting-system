<?php
session_start();



$page_tittle ="otp auth";
include('includes/header.php');
include('includes/navbar.php');
 ?>

 <div class="py-5" style="margin-bottom:8%">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-6">
       
       <?php
            if(isset($_SESSION['status']))
            {
              ?>
              <div class="alert alert-danger">
                <h5><?=$_SESSION['status']?></h5>
              </div>
              <?php
                unset($_SESSION['status']);
            }
        ?>

         <div class="card shadow">
           <div class="card-header">
             <h5>OTP Verification</h5>
           </div>
           <div class="card-body">
               <form action="otp_check.php" method="post">

               <div class="alert alert-success text-center mb-5">
                <h5>We've sent an OTP code to your email for verification - <?php echo $_SESSION['EMAIL']; ?></h5>
              </div>
                 <div class="form-group mb-3">
                   
                   <input type="text" name="otp" class="form-control" placeholder="Enter OTP verifcation code">
                 </div>

                 
                     <button type="submit" name="otpauth" class="btn btn-primary" style="width:100%">Login Now</button>

                     
                 
              </form>
              <hr>

              

               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   


 <?php include("includes/footer.php");?>

 