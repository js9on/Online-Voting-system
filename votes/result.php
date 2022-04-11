<?php
include 'functions.php';
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
        // MySQL Query that will get all the answers from the "poll_answers" table ordered by the number of votes (descending)
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY votes DESC');
        $stmt->execute([ $_GET['id'] ]);
        // Fetch all poll answers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Total number of votes, will be used to calculate the percentage
        $total_votes = 0;
        foreach($poll_answers as $poll_answer) {
            // Every poll answers votes will be added to total votes
            $total_votes += $poll_answer['votes'];
        }
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://kit.fontawesome.com/099d13fd12.js" crossorigin="anonymous"></script>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 
  <link rel="stylesheet" href="../includes/style.css">
  
</head>

<body>

<header id="navheader" class="sticky-top">
<div class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Votes</a>
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
        <div class="content poll-result">
          <h2 class="text-center"><?=$poll['title']?></h2>

          <div>
          <i class="fas fa-quote-right mt-4"></i>
          <p style="margin:0 10% 3% 10%;font-style: italic;"><?=$poll['descriptions']?></p>
          </div>


            <div class="wrapper">
                <?php foreach ($poll_answers as $poll_answer): ?>
                <div class="poll-question">
                    <p><?=$poll_answer['title']?> <span>(<?=$poll_answer['votes']?> Votes)</span></p>
                    <div class="result-bar" style= "width:<?=@round(($poll_answer['votes']/$total_votes)*100)?>%">
                        <?=@round(($poll_answer['votes']/$total_votes)*100)?>%
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <a href="index.php" class="btn btn-danger my-5">Back</a>
         </div>

         </div>

        </div>
     </div>
   </div>
</div>


<?php include('../includes/footer.php')?>