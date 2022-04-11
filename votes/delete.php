<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the poll ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) {
        exit('Poll doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM polls WHERE id = ?');
            $stmt->execute([ $_GET['id'] ]);
            // We also need to delete the answers for that poll
            $stmt = $pdo->prepare('DELETE FROM poll_answers WHERE poll_id = ?');
            $stmt->execute([ $_GET['id'] ]);
            // Output msg
            $msg = 'You have deleted the poll!';
            header('Location: index.php');
        } else {
            // User clicked the "No" button, redirect them back to the home/index page
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
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
            <a class="navbar-brand" href="dashboard.php">Votes</a>
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


<div class="py-8" style="margin-bottom:14%;">
  <div class="container">
    <div class="row">
      <div class="col-md-9" style="margin:auto;">

      <div class="card shadow my-5 px-4"> 

        <div class="content delete">
          <h2>Delete Poll </h2>
            <?php if ($msg): ?>
            <p><?=$msg?></p>
            <?php else: ?>
          <p>Are you sure you want to delete poll ?</p>
            <div class="yesno">
                <a href="delete.php?id=<?=$poll['id']?>&confirm=yes">Yes</a>
                <a href="delete.php?id=<?=$poll['id']?>&confirm=no">No</a>
            </div>
            <?php endif; ?>
        </div>
            </div>
        </div>
     </div>
  </div>
</div>



<?php include('../includes/footer.php')?>