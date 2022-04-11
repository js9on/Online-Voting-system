<?php


include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();
// MySQL query that retrieves all the polls and poll answers
$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id');
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="../includes/style.css">
  
</head>



<body>

<header id="navheader" class="sticky-top">
<div class="bg-dark" >
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



<div class="py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <div class="card shadow my-2 px-4">

        <div class="content home mb-5">
          <h2>Community Polling</h2>
          <p class="mt-2">Welcome to the community voting! You can view the list of polls below.</p>
          
          
          <a href="create.php" class="create-poll">Create Poll</a>

          <table id="my"  >
                <thead>
                    <tr>   
                        <td>Title</td>
                <td>Answers</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($polls as $poll): ?>
                    <tr>
                        
                        <td style="color:black;"><?=$poll['title']?>
                    <p style="font:small-caption; color:#5b5b5b; font-style: italic; "><?=$poll['descriptions']?></p>
                    </td>
                <td><?=$poll['answers']?></td>
                        <td class="actions">

                      
                  <a href="vote.php?id=<?=$poll['id']?>" class="view" title="View Poll"><i class="fas fa-eye fa-xs"></i></a>
                  
                  <a href="delete.php?id=<?=$poll['id']?>" class="trash" title="Delete Poll"><i class="fas fa-trash fa-xs"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                    </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
        <script src="../admins/js/export.js"></script>


 <?php include('../admins/scripts.php') ?>
<?php include('../includes/footer.php')?>
