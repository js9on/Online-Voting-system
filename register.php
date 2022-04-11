<?php

session_start();

$page_tittle ="Registration form";
include('includes/header.php');
include('includes/navbar.php');
 ?>

<div class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
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
                <div class="card-header" id="cardid-register">
                  <h5>Registration Form</h5>
                </div>
                        <div class="card-body">
                                    <form action="inc.register.php" method="post">
                                      <div class="form-group mb-3">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                      </div>
                                      <div class="form-group mb-3">
                                        <label for="">Student Number</label>
                                        <input type="text" name="id" class="form-control">
                                      </div>
                                      <div class="form-group mb-3">
                                        <label for="">Email address</label>
                                        <input type="text" name="email" class="form-control">
                                      </div>
                                      <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="pwd" class="form-control">
                                      </div>
                                      <div class="form-group mb-3">
                                        <label for="">Comfirm password</label>
                                        <input type="password" name="cpwd" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                                      </div>
                                    </form>
                            </div>
                  </div>
          </div>
        </div>
      </div>
    </div>







 <?php include("includes/footer.php");?>
