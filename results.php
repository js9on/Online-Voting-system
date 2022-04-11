<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
include('dbcon.php');

if(file_exists("admins/data.txt")){
  $file="admins/data.txt";
  $current = file_get_contents($file);
}
?>
<?php

$query = "select * from candidate";
$result = mysqli_query($con,$query);

?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          
          <?php

          while($chart = mysqli_fetch_assoc($result))
          {
            echo "['".$chart['candidate_name']."',".$chart['votes']."],";
          }


          ?>
        ]);

        var options = {
          title: '<?php echo $current ?>',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  



<div class="py-8 ">
  <div class="container">
    <div class="row">
      <div class="col-md-12 my-5" >


   
<h2>The results of the main poll</h2>
<hr>

<div class="card shadow">

<div class="d-flex flex-row">

<div id="donutchart" style="width: 800px; height: 600px;"></div>


<div class="prediction " >

        <?php
        $sql = "SELECT 	candidate_name, 	votes FROM candidate WHERE votes = (select max(votes) from candidate)";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)) {
          $highestvalue = $row['candidate_name'];
          $voter = $row['votes'];
          ?>
        <div class="card border-primary mb-3 " style="max-width: 18rem; margin-top:50%">
          <div class="card-header" style="font-weight: bold;">The Highest Chance of Winning</div>
          <div class="card-body text-primary">
            <h5 class="card-title"><?php echo $highestvalue ?></h5>
            <p class="card-text">Number of votes: <?php echo $voter ?>  </p>
          </div>
        </div>

        <?php } ?>





        <?php
        $sql = "SELECT 	candidate_name, 	votes FROM candidate WHERE votes = (select min(votes) from candidate)";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)) {
          $highestvalue = $row['candidate_name'];
          $voter = $row['votes'];
          ?>
        <div class="card border-primary mb-3" style="max-width: 18rem;">
          <div class="card-header" style="font-weight: bold;">The Lowest Chance of Winning</div>
          <div class="card-body text-primary">
            <h5 class="card-title"><?php echo $highestvalue ?></h5>
            <p class="card-text">Number of votes: <?php echo $voter ?>  </p>
          </div>
        </div>

        <?php } ?>


</div>
</div>

<a href="mainvotes.php" class="btn btn-primary btn-lg active mb-3" role="button" aria-pressed="true" style="width:15%;margin-left:20px;">Return</a>

</div>
      </div>
    </div>
  </div>
</div>














<?php include('includes/footer.php');?>