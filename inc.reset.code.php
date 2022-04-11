<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


function send_password_reset($get_name,$get_email,$token)
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

  $mail->setFrom('jsonchongmin@gmail.com', $get_name);
  $mail->addAddress($get_email);     //Add a recipient

  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Reset Password Notification';

  $email_template = "
    <h2>Greetings!</h2>
    <h3>A request has been received to change the password for your account with the given link below.</h3>
    <br></br>
    <a href='http://localhost/FinalVotingSystem/password-change.php?token=$token&email=$get_email'>click here</a>
  ";

  $mail ->Body = $email_template;
  $mail ->send();
  //echo'Message has been sent';
}




if(isset($_POST['password-reset-link']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT usersEmail FROM users WHERE usersEmail='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows($check_email_run)>0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['usersName'];
        $get_email = $row['usersEmail'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE usersEmail='$get_email' LIMIT 1 ";
        $update_token_run = mysqli_query($con, $update_token);
        
        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] = "A request for password reset link is e-mailed to you"; 
            header("location: password-reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong";
            header("location: password-reset.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No email found";
        header("location: password-reset.php");
        exit(0);
    }


}

if(isset($_POST['password_update']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $comfirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $token = mysqli_real_escape_string($con, $_POST['password_token']);
    
    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($comfirm_password))
        {
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1 ";
            $check_token_run = mysqli_query($con, $check_token);

            if(mysqli_num_rows($check_token_run) > 0)
            {
                if($new_password == $comfirm_password)
                {
                    $hashedPwd = password_hash($new_password,PASSWORD_DEFAULT);


                    $update_password = "UPDATE users SET usersPwd='$hashedPwd' WHERE verify_token='$token' LIMIT 1 ";  
                    $update_password_run = mysqli_query($con, $update_password);

                    if($update_password_run)
                    {
                        $_SESSION['status'] = "New password successfully updated!";
                        header("location: login.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status'] = "Did not update password, Something went wrong!";
                        header("location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['status'] = "Password and comfirm password does not match";
                    header("location: password-change.php?token=$token&email=$email");
                    exit(0);
                }

            }
            else
            {
                $_SESSION['status'] = "invalid token";
                header("location: password-change.php?token=$token&email=$email");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "All fields are mandatory, please fill in";
            header("location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No token available";
        header("location: password-change.php");
        exit(0);
    }



}











?>