<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token)
{
  $mail = new PHPMailer(true);

  $mail->isSMTP();                                            //Send using SMTP
  $mail->SMTPAuth   = true;
  $mail->SMTPDebug  = 1;
  $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
    
  $mail->Host       = 'smtp.gmail.com';
  $mail->Username   = 'jsonchongmin@gmail.com';                     //SMTP username
  $mail->Password   = 'Mirana_1109';                               //SMTP password

  $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
  $mail->Port       = 587;

  $mail->setFrom('jsonchongmin@gmail.com', $name);
  $mail->addAddress($email);     //Add a recipient

  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Email verification from Voting system';

  $email_template = "
    <h2>you have registered with votes</h2>
    <h4>Verify your email addresss to login with the given link below</h4>
    <br></br>
    <a href='http://localhost/FinalVotingSystem/verify-email.php?token=$verify_token'>click here</a>
  ";

  $mail ->Body = $email_template;
  $mail ->send();
  //echo'Message has been sent';

}



if(isset($_POST['register_btn']))
{
  $name = $_POST['name'];
  $id = $_POST['id'];
  $email = $_POST['email'];
  $password =  $_POST['pwd'];
  $cpassword = $_POST['cpwd'];
  $verify_token = md5(rand());

  require_once 'includes/functions.php';
 

  if(emptyInputSignup($name, $email, $id, $password, $cpassword)!== false)
  {
    $_SESSION['status'] = "Please fill in blanks! ";
    header("location:register.php?error=emptyfsd");
    exit();
  }

  if(idlength($id)!== false)
  {
    $_SESSION['status'] = "invalid ID!";
    header("location:register.php?error=invalidid");
    exit();
  }

  if(numberonly($id)!== false)
  {
    $_SESSION['status'] = "Student ID must be in numerical form";
    header("location:register.php?error=numericform");
    exit();
  }

  if(invalidName($name)!== false)
  {
    $_SESSION['status'] = "invalid Name! ";
    header("location:register.php?error=invalidName");
    exit();
  }

  if(invalidEmail($email)!== false)
  {
    $_SESSION['status'] = "invalid Email! ";
    header("location:register.php?error=invalidemail");
    exit();
  }

  if(pwdMatch($password,$cpassword)!== false)
  {
    $_SESSION['status'] = "passwords dont match! ";
    header("location: register.php?error=passdontmatch");
    exit();
  }

  $hashedPwd = password_hash($password,PASSWORD_DEFAULT);


  //email exists or not
  $check_email_query = "SELECT usersStudentID FROM users WHERE  usersStudentID='$id' LIMIT 1";
  $check_email_query_run = mysqli_query($con,$check_email_query);

  if(mysqli_num_rows($check_email_query_run) > 0)
  {
    $_SESSION['status'] = "Email or ID already exists! ";
    header("Location: register.php");
    

  }
  else
  { 
  
    $query = "INSERT INTO users (usersName,usersStudentID,usersEmail,usersPwd,verify_token) VALUES ('$name','$id','$email','$hashedPwd','$verify_token')";
    $query_run = mysqli_query($con,$query);

    if($query_run)
    {
      sendemail_verify("$name","$email","$verify_token");

      $_SESSION['status'] = "Registration Succesfull! Please verify your Email address";
      header("Location: register.php");
    }
    else
    {
      $_SESSION['status'] = "Registration failed";
      header("Location: register.php");
    }
    
  }
  

}



?>















