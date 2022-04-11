



<div class="container my-3">
<div class="row justify-content-center">




<div class="col-md-3" >
    <div class="card text-center">
      <div class="card-header bg-primary text-white">
        <div class="row align-items-center">
          <div class="col p-0">
            <i class="fas fa-vote-yea fa-3x"></i>
          </div>
          <div class="col p-0">
<?php
          if($_SESSION['can_status']==1){
  echo "<h3 class='display-5'> voted</h3>";
}
else{
  echo "<h3 class='display-5'> not voted</h3>";
}
?>
            <h6>Main Poll</h6>

          </div>
        </div>
      </div>
      <div class="card-footer">
        <h5>
          <a href="mainvotes.php" class="text-primary">View Details <i class="fas fa-arrow-alt-circle-right"></i></a>
        </h5>
      </div>
    </div>
  </div>

 

  <?php
  $sql="SELECT notice_title FROM notice";
  if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcounts=mysqli_num_rows($result);?>


  <div class="col-md-3">
    <div class="card text-center">
      <div class="card-header bg-secondary text-white">
        <div class="row align-items-center">
          <div class="col p-0">
            <i class="fas fa-users-cog fa-3x"></i>
          </div>
          <div class="col p-0">
            <h3 class="display-3"><?php echo $rowcounts?></h3>
            <h6>News Feed</h6>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <h5>
          <a href="dashboard.php" class="text-primary">View Details <i class="fas fa-arrow-alt-circle-right"></i></a>
        </h5>
      </div>
    </div>
  </div>
  <?php }?>


  <?php
  $sql="SELECT title FROM polls ";
  if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcountss=mysqli_num_rows($result);?>

  <div class="col-md-3">
    <div class="card text-center">
      <div class="card-header bg-success text-white">
        <div class="row align-items-center">
          <div class="col p-0">
            <i class="fas fa-poll-h fa-4x"></i>
          </div>
          <div class="col p-0">
            <h3 class="display-3"><?php echo $rowcountss?></h3>
            <h6>Community Vote</h6>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <h5>
          <a href="votes/index.php" class="text-primary">View Details <i class="fas fa-arrow-alt-circle-right"></i></a>
        </h5>
      </div>
    </div>
  </div>
</div>

<?php }?>



</div>

