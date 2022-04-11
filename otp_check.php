<?php
session_start();
$con=mysqli_connect('localhost','root','','voting');

if(isset($_POST['otpauth'])){
        $otp=$_POST['otp'];
        $email=$_SESSION['EMAIL'];
        $res=mysqli_query($con,"select * from users where usersEmail='$email' and otp='$otp'");
        $count=mysqli_num_rows($res);
        if($count>0){
              mysqli_query($con,"update users set otp='' where usersEmail='$email'");

              $check_query = "SELECT * FROM users WHERE (usersEmail='$email' OR usersStudentID = '$email') LIMIT 1 ";
              $check_query_run = mysqli_query($con, $check_query);

              if(mysqli_num_rows($check_query_run)> 0)
                    {
                            $row = mysqli_fetch_array($check_query_run);

                          $_SESSION['authenticated'] = TRUE;
                          $_SESSION['auth_user'] = [
                              'username' => $row['usersName'],
                              'id' => $row['usersStudentID'],
                              'email' => $row['usersEmail'],
                              'ids' => $row['id'],
                              'status' => $row['vote_status'],
                              

                          ];

                          
                              $_SESSION['status'] = "you are logged in successfully";
                              header("location: dashboard.php");
                              exit(0);
                            
                    }

        }
        else
        {
          $_SESSION['status'] = "Please enter correct OTP number";
                header("location: otpauth.php");
                exit(0);
        }
}
?>