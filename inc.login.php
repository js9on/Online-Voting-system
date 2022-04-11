<?php
session_start();
include('dbcon.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($to,$subject, $msg)
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

  $mail->setFrom('jsonchongmin@gmail.com',);
   //Add a recipient

  $mail->isHTML(true);                                  //Set email format to HTML



$mail->Subject = $subject;
  $mail ->Body = $msg;

	$mail->AddAddress($to);
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
}


if(isset($_POST['login_now_btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['pwd'])))
    {
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['pwd']);

        $adlog_query = "SELECT * FROM admins WHERE adminEmail='$email' AND adminPass='$password'  LIMIT 1";
        $adlog_query_run = mysqli_query($con, $adlog_query);

        $login_query = "SELECT * FROM users WHERE (usersEmail='$email' OR usersStudentID = '$email') LIMIT 1 ";
        $login_query_run = mysqli_query($con, $login_query);

        

        if(mysqli_num_rows($adlog_query_run)> 0)
        {
            $rows= mysqli_fetch_array($adlog_query_run);
            
                

                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_admin'] = [
                    'username' => $rows['adminEmail'],
                    'id' => $rows['id'],
                    'status' => $rows['vote_status'],];

                    $_SESSION['status'] = "you are logged in successfully";
                    header("location: admins/admin.php");
                    exit(0); 

        }
        else if(mysqli_num_rows($login_query_run)> 0)
        {
            $row = mysqli_fetch_array($login_query_run);
            
            if($row['verify_status'] == "1")
            {
                    if(password_verify($password,$row['usersPwd'])){
     
                        $mail = $row['usersEmail'];
                        

                        $otp=rand(111111,999999);
                        mysqli_query($con,"update users set otp='$otp' where usersEmail='$mail'");
                        $html="Your otp verification code is ".$otp;
                        $_SESSION['EMAIL']=$mail;
                        sendemail_verify("$mail","OTP verification","$html");
                        header("location:otpauth.php");
                                
                    }
                    
                    else
                    {
                        $_SESSION['status'] = "Incorrect login! Please try again";
                        header("location: login.php");
                        exit(0);

                    }
            }
            else
            { 
                $_SESSION['status'] = "Please verify your email address to login";
                header("location: login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Invalid Email or password";
            header("location: login.php");
            exit(0);
        }
        
        
    }
    else
    {
        $_SESSION['status'] = "all fields are mandatory";
        header("location: login.php");
        exit(0);
    }

 

    
}



?>
