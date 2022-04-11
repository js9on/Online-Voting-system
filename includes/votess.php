<?php
    session_start();
    include("../dbcon.php");

    $votes = $_POST['gvotes'];
    $total_votes= $votes+1;
    $gid = $_POST['gid']; 
     $uid = $_POST['uid'];
    

     $update_votes = mysqli_query($con, "update candidate set votes='$total_votes' where id='$gid'");
     $update_status = mysqli_query($con, "update  candidate set can_status=1 where can_status=0");
     $update_userstatus = mysqli_query($con, "update voting set vote_status=1 where id='$uid'");
 
     if($update_status and $update_votes){
         $getGroups = mysqli_query($con, "select candidate_name, votes, id, can_status from candidate ");
         $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
         $_SESSION['groups'] = $groups;
         $_SESSION['can_status'] = 1;
         

         echo '<script>
                     alert("Voting successfull!");
                     window.location = "../results.php";
                 </script>';
     }
     else{
         echo '<script>
                     alert("Voting failed!.. Try again.");
                     window.location = "../routes/dashboard.php";
                 </script>';
     }
    
?>