<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

error_reporting(0);


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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 
        <link rel="stylesheet" href="../includes/style.css">
  
</head>

<style>
.navbar-nav {

padding:8px !important;
}


</style>

    <body>

    <header id="navheader" class="sticky-top">
<div class="bg-dark" >
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

<div class="py-8" style="margin-bottom:2%;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php
                    if (isset($_POST['submit'])) {

                        $f1 = $_POST['f1'];
                        $f2 = $_POST['f2'];
                        $title = $_POST['title'];
                        $des = $_POST['description'];
                        

                        $query = "INSERT INTO tb1 (f1,f2) VALUES ('$f1','$f2')";

                        $result = mysqli_query($conn, $query);
                        $student_id = $conn->insert_id;


                          foreach ($_POST['offene_pukte'] as $key => $value) {

                            $query3 = "INSERT INTO poll_answers(poll_id,title,vote_status)VALUES ('" . $student_id -5 . "','" . $_POST['offene_pukte'][$key] . "','" . $_POST['intern'][$key] . "')";
                            mysqli_query($conn, $query3);
                        }

                        $addstuff = "INSERT INTO polls(title,descriptions) VALUES ('$title','$des')";
                        $addstuff_run = mysqli_query($conn,$addstuff);
                        
                        header("location:index.php");


                        
                        
                    }
                    ?>


      <form action="" method="post" enctype="">
                        
              <div class="card shadow my-5">
                  <div class="card-header">
                  <h2 class="text-center">Create your poll</h2>
                  </div>
                  <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Please enter question" required >
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="description" id="description" placeholder="Description" required ></textarea>
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="choices">Choices</label>
                            <div id="dynamic_field3">
                                <div class="form-row">
                                    <div class="col mb-2">
                                        <input type="text" class="form-control" name="offene_pukte[]" placeholder="choose an answer"  required>
                                    </div>                                               
                                    <div class="col">
                                        <td><button type="button" name="add" id="add3" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                    <div class="form-group mb-3">
                        
                            <button type="submit" id='submit' name="submit" class="btn btn-success " value="Save">Create Poll</button>
                            <a href="index.php" id="back">Back</a>
                              
                    </div>
                  </div>
              </div>
      </form>

      </div>
    </div>
  </div>
</div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                var i = 1;
                
                $('#add3').click(function () {
                    i++;
                    $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"> <div class="col"> <input type="text" class="form-control"  name="offene_pukte[]"> </div> <div class="col"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa-trash-o"></i></button></td> </div> </div>');
                });
                $(document).on('click', '.btn_remove3', function () {
                    var button_id = $(this).attr("id");

                    $('#row3' + button_id + '').remove();
                });



            });
        </script>


<?php include('../includes/footer.php')?>