<?php
session_start();

$page_title = "password change update";
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="py-5">
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
                    <h5>Change password</h5>
                </div>
                <div class="card-body p-4">
                    <form action="inc.reset.code.php" method="post";>
                        <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">

                        <div class="form-group mb-3">
                            <label class="mb-2" >Email address</label>
                            <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" class="form-control" placeholder="Enter email address">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2">New password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2">Comfirm password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Enter new password again">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="password_update" class="btn btn-success w-100">Update password</button>
                        </div>                        
                    </form>
                </div>
                </div>


            </div>



            </div>
        </div>

    </div>
</div>

<?php
include('includes/footer.php');
?>