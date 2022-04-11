
<?php

include('authentication.php');
$page_tittle ="Dashboard";
include('dbcon.php');
include('includes/header.php');
include('includes/navbar.php');


  $check = mysqli_query($con, "select * from candidate ");
  $data = mysqli_fetch_array($check);
          $_SESSION['id'] = $data['id'];
          $_SESSION['can_status'] = $data['can_status'];
          $_SESSION['data'] = $data;

  $message="";
  $selectStatus = "SELECT * FROM admins WHERE id=1";
  $status = mysqli_query($con,$selectStatus);
  $res = mysqli_fetch_assoc($status);
  if($res['vote_status'] == "on"){
      $message="Voting Started";
  }else{
      $message="Not started yet";
  }    

 ?>

 <style>

#top{
  border: 1px #D3D3D3 !important

}

#btm{

  border: 1px #D3D3D3 !important

}

.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}

.alb img {
			width: 100%;
			height: 100%;
		}

    #text{
      text-align: justify;
      margin: 10px 0 10px 0;
    }

 </style>


<?php
            if(isset($_SESSION['status']))
            {
              ?>
              <div class="alert alert-success mt-2 text-center" style="width:69%;margin:auto;position:absolute;z-index:2;left:15.5%;">
                <h5><?=$_SESSION['status']?></h5>
              </div>
              <?php
                unset($_SESSION['status']);
            }
        ?>


<div class="py-8 my-5 ">
  <div class="container">
    <div class="row">
      <div class="col-md-12 card py-5" >
      
      


      <?php include('cardsnotice.php')?>

      <br>
      <div>

      <?php  if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } ?>
        <h6 style="font-size: 1.4rem;">Voting status: <span style="color:red; background-color:#061d59;border-radius:5px;padding:5px;"><?php echo $message ?></span></h6>
      </div>
      <hr>
      <div id=text class="p-3">
      <b>step by step guideline</b>
      <br><br>
      <p>The first step of creating a poll is entering the question you want to ask. A recommendation is to keep it short and on point, 
  there will be an option to add a description text later on, where you can explain further details of your concern. Furthermore, 
  make sure that you add all the answer options you can think of,
   since you can't change them later. Otherwise, the poll results might be falsified for users that voted before the change.</p> 
   <br>
   <p>Moreover, the results of the poll can be seen in the same page and can only be seen if the voting poll is still opened by the admin.
     if the admin closes the poll or the timer runs out the poll will be closed. furthermore, the admin can also issue an email to all users with
     the results. in addition to that, polls can also be shared from the community poll to attract more users to vote for the polls.
   </p>
      
      <hr>
      </div>

      <h2>News Feed</h2>
        <hr>


        <?php
              


                $sql = "SELECT  * FROM notice order by notice_at desc";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result)> 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {?>



                <div class="card shadow my-3" id="myDIV">
                    <div class="card-header" id="top"><strong><?php echo $row['notice_title']; ?></strong> </div>
                <div class="card-body" id="btm">

                    
                    <hr>
                    <div><?php echo $row['notice_content'];?></div>
                    <br>
                  <div class="alb">
                    <img src="admins/includesad/uploads/<?=$row['notice_picture']?>" onerror="this.style.display = 'none';">
                  </div>
                    <br>
                    <div class>Date: Posted on <?php echo $row['notice_at']; ?></div>
                    <hr>                   
                    <button class="btn btn-outline-secondary float-right" style="float: right;" onclick="myFunction()">Hide</button>
                  </div>
                </div>


               <?php }} ?>

    </div>
  </div>
 </div>
</div>


<script>

function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

</script>





<?php include('includes/footer.php');?>
