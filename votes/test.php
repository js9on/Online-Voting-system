<?php


$page_tittle ="Notice page";


include('../admins/adminnav.php');

include 'functions.php';
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





<div class="py-8">
  <div class="container">
    <div class="row">
      <div class="col-md-12 card shadow mt-5">
      <div class="container">
        <br>
        <h3 class="titulo-tabla">Announcement & Notice management</h3>
        <hr>

        

                    
                            <table id="example" class=" table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                          <th>title</th>
                                          <th>answers</th>
                                          <th></th>
                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($polls as $poll): ?>
                                        <tr>
                                        <td style="color:black;"><?=$poll['title']?>
                    <p style="font:small-caption; color:#5b5b5b; font-style: italic; "><?=$poll['descriptions']?></p>
                    </td>
                <td><?=$poll['answers']?></td>
                                            <td>
                                                  
                                                  <button type="button" value= "<?php echo $row['notice_id']; ?>" class="fa fa-edit btn-sm updatebtn btn btn-success"></button>
                                                  <button type="button" value= "<?php echo $row['notice_id']; ?>" class="fa fa-trash btn-sm deletebtn btn btn-danger"></button>
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



<?php include('../admins/adminfoot.php'); ?>