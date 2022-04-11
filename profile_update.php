<?php
session_start();



$page_tittle ="profile update form";
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
              <div class="alert alert-danger">
                <h5><?=$_SESSION['status']?></h5>
              </div>
              <?php
                unset($_SESSION['status']);
            }
        ?>

         <div class="card shadow">
           <div class="card-header">
             <h5>Profile Information</h5>
           </div>
           <div class="card-body">
               <form action="" method="post">

               <input type="hidden" name="id" value="<?= $_SESSION['auth_user']['ids']; ?>">

                  <div class="form-group mb-3">
                   <label for="">Name</label>
                   <input type="text" name="name" class="form-control" value="<?= $_SESSION['auth_user']['username']; ?>">
                 </div>
                 <div class="form-group mb-3">
                   <label for="">Student Number</label>
                   <input type="text" name="studentid" class="form-control" value="<?= $_SESSION['auth_user']['id']; ?>">
                 </div>
                 <div class="form-group mb-3">
                   <label for="">Email</label>
                   <input type="text" name="email" class="form-control" value="<?= $_SESSION['auth_user']['email']; ?>">
                 </div>
                 <div class="form-group mb-3">
                   <label for="">Password</label>
                   <input type="password" name="pwd" class="form-control">
                 </div>
                 <div class="form-group mb-3">
                   <label for="">Comfirm Password</label>
                   <input type="password" name="cpwd" class="form-control" >
                 </div>

                 <div class="form-group">
                     <button type="submit" name="updatenow" class="btn btn-primary">Update Now</button>

                 </div>
              </form>
              <hr>

              

               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   

     <?php
include('dbcon.php');

if(isset($_POST['updatenow']))
{
  $ids =  $_POST['id'];
  $name = $_POST['name'];
  $id = $_POST['studentid'];
  $email = $_POST['email'];
  $password =  $_POST['pwd'];
  $cpassword = $_POST['cpwd'];
  

  require_once 'includes/functions.php';
 

  if(emptyInputSignup($name, $email, $id, $password, $cpassword)!== false)
  {
    $_SESSION['status'] = "Please fill in blanks! ";
    header("location:profile_update.php?error=emptyfsd");
    exit();
  }

  if(idlength($id)!== false)
  {
    $_SESSION['status'] = "invalid ID!";
    header("location:profile_update.php?error=invalidid");
    exit();
  }

  if(numberonly($id)!== false)
  {
    $_SESSION['status'] = "Student ID must be in numerical form";
    header("location:profile_update.php?error=numericform");
    exit();
  }

  if(invalidName($name)!== false)
  {
    $_SESSION['status'] = "invalid Name! ";
    header("location:profile_update.php?error=invalidName");
    exit();
  }

  if(invalidEmail($email)!== false)
  {
    $_SESSION['status'] = "invalid Email! ";
    header("location:profile_update.php?error=invalidemail");
    exit();
  }

  if(pwdMatch($password,$cpassword)!== false)
  {
    $_SESSION['status'] = "passwords dont match! ";
    header("location: profile_update.php?error=passdontmatch");
    exit();
  }

  $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

   $query = "UPDATE users SET usersStudentID='$id', usersName='$name', usersEmail='$email', usersPwd='$hashedPwd' WHERE id='$ids'";
  $query_run = mysqli_query($con,$query);

  if($query_run)
    {
      
      $_SESSION['status'] = "Information succesfully updated";
      
    }
    else
    {
      $_SESSION['status'] = "Information failed to update";
      
    }




  
  

}



?>


 <?php include("includes/footer.php");?>