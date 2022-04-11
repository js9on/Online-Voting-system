<?php
include 'functions.php';
include("sharingbuttons.php");
// Connect to MySQL
$pdo = pdo_connect_mysql();
// If the GET request "id" exists (poll id)...
if (isset($_GET['id'])) {
    // MySQL query that selects the poll records by the GET request "id"
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    // Fetch the record
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the poll record exists with the id specified
    if ($poll) {
        // MySQL query that selects all the poll answers
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt->execute([ $_GET['id'] ]);
        // Fetch all the poll anwsers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // If the user clicked the "Vote" button...
        if (isset($_POST['poll_answer'])) {

          $secret = "6Lc8CBgdAAAAAGKMIYOLLCSZAQMSi1lDvyCKdoRQ";
          $response = $_POST['g-recaptcha-response'];
          $remoteip = $_SERVER['REMOTE_ADDR'];
          $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
          $data = file_get_contents($url);
          $row = json_decode($data, true);

          if($row['success'] == "true"){
            $stmt = $pdo->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt->execute([ $_POST['poll_answer'] ]);

            $s = $pdo->prepare('UPDATE polls SET vote_status="1" WHERE id = ?');
            $s->execute([ $_GET['id'] ]);


            // Redirect user to the result page

            echo "<script>
            alert('Vote has been casted successfully!');
            window.location.href='result.php?id=".$_GET['id']."';
            </script>";
 

            exit;

            
        }
        else{
            echo"<script>alert('Please Verify CAPTCHA');</script>";
        }
  
        }
            
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}

?>

<?php
$stmt = $pdo->prepare('SELECT * FROM polls WHERE id= ?');
$stmt->execute([ $_GET['id'] ]);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $_SESSION['votestatus'] = $row['vote_status'];

}

$id =  $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php if(isset($page_tittle))
    {
      echo "$page_tittle";} ?> - Logo Name
  </title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://kit.fontawesome.com/099d13fd12.js" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="../includes/style.css">
  <link rel="stylesheet" type="text/css" href="sharingbuttons.css"/>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

 
</head>

<body>

<header id="navheader" class="sticky-top">
<div class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="../dashboard.php">Votes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                  <a class="nav-link" href="../dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../mainvotes.php">Voting</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Community voting</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../profile_update.php">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../logout.php">Log out</a>
                </li>               
              </ul>
            </div>
          </div>
        </nav>
    </div>
  </div>
 </div>
</div>
</header>




<div class="py-8">
  <div class="container">
    <div class="row">
      <div class="col-md-9" style="margin:auto;">

      <div class="card shadow my-5 px-4">

            <div class="content poll-vote mb-4 ">
              <h2 class="text-center"><?=$poll['title']?></h2>
                <br>
            <div>
            <i class="fas fa-quote-right"></i>
              <p style="margin:0 10% 3% 10%;font-style: italic;"><?=$poll['descriptions']?></p>
              </div>
              
              <div class="font-weight-light mb-2" style="opacity: 0.5;">Choose one answer:</div>
                <form action="vote.php?id=<?=$_GET['id']?>" method="post">
                    <?php for ($i = 0; $i < count($poll_answers); $i++): ?>
                    <label>
                        <input type="radio" name="poll_answer" value="<?=$poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
                        <?=$poll_answers[$i]['title']?>
                    </label>
                    <?php endfor; ?>

                    <div class=row>
    <div class="g-recaptcha" data-sitekey="6Lc8CBgdAAAAAOciaLWqUFlH_dWb8RO5y7yifK_v"></div>

                    </div>


                    <div>
                    <?php

                        if($_SESSION['votestatus']==1){
                            ?>
                            <a href="result.php?id=<?=$poll['id']?>" style="background-color:#6495ED;"><i class=" fas fa-poll-h" style="margin-right:5px;"></i>View Result</a>
                            <?php
                        }
                        else{
                            ?>
                            <input type="submit" name="submit" value="Vote">
                            <?php  } ?>
                        <a href="index.php">Back</a>
                </form>
                    </div>

                            <div style="float:right;">
                            <div style="text-align:center;"><i class="fas fa-share"> Share</i></div>
                            <?php
		showSharer("http://localhost/loginform/votes/vote.php?id=$id", "Vote for your opinion now!");
		?>
                       
                       </div>

          </div>
        </div>
      </div>
   </div>
</div>





<?php include('../includes/footer.php')?>





