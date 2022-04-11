<?php

$con = mysqli_connect("localhost","root","","voting");
session_start();




$res = mysqli_query($con, "UPDATE admins SET vote_status = 'off'");
if ($res) {
    unset($_SESSION['on']);
    $_SESSION['message'] = "Voting closed";
    unset($_SESSION['duration']);
    unset($_SESSION["start_time"]);
    unset($_SESSION["end_time"]);
    unset($_SESSION['load']);
    unset($_SESSION['load']);


    
    echo "<script>
            alert('Voting session is closed');
            window.location.href='dashboard.php';
            </script>";
}


?>