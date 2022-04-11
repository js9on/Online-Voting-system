<?php
session_start();

if(isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "You are already logged in!";
    header('location: dashboard.php');
    exit(0);
}

$page_tittle ="Login form";
include('includes/header.php');
include('includes/navbar.php');
 ?>

 <div class="py-5">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-6" style="margin-bottom:14%;">
       
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
             <h5>Login Form</h5>
           </div>
           <div class="card-body">
               <form action="inc.login.php" method="post">

                 <div class="form-group mb-3">
                   <label for="">Student ID</label>
                   <input type="text" name="email" class="form-control">
                 </div>
                 <div class="form-group mb-3">
                   <label for="">Password</label>
                   <input type="password" name="pwd" class="form-control">
                 </div>

                 <div class="form-group">
                     <button type="submit" name="login_now_btn" class="btn btn-primary">Login Now</button>

                     <a href="password-reset.php" class="float-end">forgot your password?</a>
                 </div>
              </form>
              <hr>

              <h5>
                Did not recieve your verification email?
                <a href="resend-email-verification.php">Resend</a>

              </h5>

               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   


 <?php include("includes/footer.php");?>
