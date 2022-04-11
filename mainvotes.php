<?php

session_start();
include('includes/header.php');

include('includes/navbar.php');

$con = mysqli_connect("localhost", "root", "", "voting");

$selectStatus = "SELECT * FROM admins WHERE id=1";
$status = mysqli_query($con,$selectStatus);
$res = mysqli_fetch_assoc($status);
if($res['vote_status'] == "off"){
    echo "<script>
            alert('Voting session is closed');
            window.location.href='dashboard.php';
            </script>";
}
else{
    
    if(!isset($_SESSION['load'])){
        $duration="";
        $res = mysqli_query($con,"SELECT timed FROM duration");
        while($row = mysqli_fetch_array($res)){
            $duration=$row["timed"];
        }
        $_SESSION['duration']=$duration;
        $_SESSION['start_time']=date("Y-m-d H:i:s");
        $end_time = $end_time=date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"].'minutes',strtotime($_SESSION["start_time"])));
        $_SESSION["end_time"]=$end_time;
        $_SESSION['load']="once";
        $_SESSION['load']="loaded";
    }else{
    }
}



$check = mysqli_query($con, "select * from candidate ");

$getGroups = mysqli_query($con, "select * from candidate ");
        if(mysqli_num_rows($getGroups)>0){
            $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
            $_SESSION['groups'] = $groups;
        }

       
            $data = mysqli_fetch_array($check);
        $_SESSION['id'] = $data['id'];
        $_SESSION['can_status'] = $data['can_status'];
        $_SESSION['data'] = $data;

        $data = $_SESSION['data'];

       

        if($_SESSION['can_status']==1){
            $status = '<b style="color: green">Voted</b>';
        }
        else{
            $status = '<b style="color: red">Not Voted</b>';
        }
            
        if(file_exists("admins/data.txt")){
            $file="admins/data.txt";
            $current = file_get_contents($file);
          }
             

?>

<script>
var interval = setInterval(function(){
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","response.php",false);
xmlhttp.send(null);
// console.log(typeof(xmlhttp.responseText));
if(xmlhttp.responseText == "-1"){
 clearInterval(interval);
 window.location = "autoDisable.php";
}else{
    document.getElementById("response").innerHTML=xmlhttp.responseText;
}
},1000);
</script>
 

<style>

#groupSection{
    padding: 20px; 
}
.float-container {
    
   
}

.float-child {
    width: 50%;
    float: left;
    
    
}  


</style>


<div class="py-8">
  <div class="container">
    <div class="row">
      <div class="col-md-10 my-5" style="margin: auto;">

      
      <h1 class="text-center" style="text-decoration:underline;margin-bottom:20px;"> <?php echo $current ?></h1>

         <div class="card shadow">
         <div class="card-header mb-2">
            <div class="float-container">
                <div class="float-child">
         <b>Status :<?php echo $status ?></b><br>
         <b>Student Name: <?= $_SESSION['auth_user']['username']; ?></b><br>
         <b>Student ID: <?= $_SESSION['auth_user']['id']; ?></b><br>
         <b>Student Email: <?= $_SESSION['auth_user']['email']; ?></b>
         </div>
         <div class="float-child sec" > 
         <h4 style="float:right;">Remaining time</h4><br><br>
         <h3 style="float:right;" id="response"></h3>
        </div>
         </div>
        
      </div>

      <div id="groupSection" class="card-content">
          <p >Select only one candidate !</p>
          
                    <?php
                    
                    if(isset($_SESSION['groups'])){
                        $groups = $_SESSION['groups'];
                        
                        for($i=0; $i<count($groups); $i++){
                            ?>

                                <div class="flex" >
                                <div class="mb-2">
                                <img src="admins/includesad/uploads/<?php echo $groups[$i]['pictures']?>" onerror="this.style.display = 'none';" style="width:100px;height:100px; float:left; margin-right:25px;">
                                
                                <b>Candidate Name : </b><?php echo $groups[$i]['candidate_name']?><br>
                                <b>Descriptions : </b><?php echo $groups[$i]['candidate_description']?>
                                </div>
                                
                                <form method="POST" action="includes/votess.php">
                                <input type="hidden" name="gvotes" value="<?php echo $groups[$i]['votes'] ?>">
                                <input type="hidden" name = "gid" value="<?php echo $groups[$i]['id'] ?>">
                                <input type="hidden" name = "uid" value="<?= $_SESSION['auth_user']['ids']; ?>">
                                <?php

                                    if($_SESSION['can_status']==1){
                                        ?>
                                        <button disabled style="padding: 5px; font-size: 15px; background-color: #27ae60; color: white; border-radius: 5px; margin-bottom:30px;" type="button">Voted</button>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <button style="padding: 5px; font-size: 15px; background-color: #3498db; color: white; border-radius: 5px;  margin-bottom: 30px;" type="submit">Vote</button>
                                        <?php
                                }
                                ?>
                                <br>
                                </form>
                                </div>  
                            <?php
                        }
                    }
                    else{
                        ?>
                            <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                                <b>No Votes available right now.</b>
                            </div>
                        <?php
                    }
                    ?>

                        <?php

                        if($_SESSION['can_status']==1){
                            ?>
                            <a href="results.php" class="btn btn-primary active" role="button" aria-pressed="true">Show Results</a>
                            <?php
                        }
                        else{
                            ?>
                            <?php  }  ?>

                </div>
            </div>

      

      </div>
    </div>
  </div>
</div>








<?php


include('includes/footer.php');

?>