<?php
session_start();


$page_title="resend email verification";

include('includes/header.php');
include('includes/navbar.php');

?>

<div class="py-5" style="margin:3% 0 13% 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

            <?php
            if(isset($_SESSION['status']))
            {
              ?>
              <div class="alert alert-success">
                <h5><?=$_SESSION['status']?></h5>
              </div>
              <?php
                unset($_SESSION['status']);
            }
            ?>

            <div class="card">
                <div class="card-header">
                    <h5>Resend Email verification</h5>
            </div>
            <div class="card-body">

            <form action="inc.resend.code.php" method="post">
                <div class="form-group mb-3">
                    <label class="mb-2"> Email Address </label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                </div>
                <div class="form-group mb-3">
                    <button type="submit" name="resend_email_verify_btn" class="btn btn-primary">Submit</button>
                </div>
            </form>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>