<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function resend_email_verify($name,$email,$verify_token)
{
    $mail = new PHPMailer(true);

  $mail->isSMTP();                                            //Send using SMTP
  $mail->SMTPAuth   = true;
  //$mail->SMTPDebug  = 1;
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
  $mail->Subject = 'Resent - Email verification from Voting system';

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





if(isset($_POST['resend_email_verify_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);

        $checkemail_query = "SELECT * FROM users WHERE usersEmail='$email' LIMIT 1 ";
        $checkemail_query_run = mysqli_query($con,$checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0 )
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == "0")
            {
                $name = $row['usersName'];
                $email = $row['usersEmail'];
                $verify_token = $row['verify_token'];


                resend_email_verify($name,$email,$verify_token);
                $_SESSION['status'] = "verification Email link has been sent to your email address!";
                header("location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Email is already verified. Please login";
                header("location: resend-email-verification.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email is not registered, Please registered now!";
            header("location: Register.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "Please enter the email field";
        header("location : resend-email-verification.php");
        exit(0);
    }
}






?>
