<?php
  if (!session_id()) {
    session_start();
  }
  include_once('db.php');
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title>Online Movie Tickets Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/rotating-card.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dark.css" rel="stylesheet">
    <link href="css/anotherDefault.css" rel="stylesheet">
  </head>

  <body>
    <!-- NAVBAR  -->
    <?php include 'navbar.php'; ?>
    <?php include 'carousel.php'; ?>

    <?php 
    if (!empty($_SESSION['msg'])) {
      echo "
      <p style='font-family: cursive; text-align: center; color: #5c865c; font-size: 2vw;'>".$_SESSION['msg']."</p>
      ";
      $_SESSION['msg']="";
      $_SESSION['movieId']="";
    }
    ?>

    <div class="container">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="nowshowing">
              <?php 
              $count=0;
              $stmt = $conn->query("select * from movielist;");
              $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach ($res as $row) {
                // $_SESSION['movie']=;

                if ($count==4) {
                  echo "<div class='row'>";
                  $count=0;
                }

                echo " 
                <div class='col-md-3 col-sm-6 col-xs-12'>
                  <div class='card-container'>
                    <a href='movie.php?id=".$row['movieId']."'>
                      <div class='card'>
                      <div class='front' style='background-color: #161b22; color:#c9d1d9'>
                        <div class='cover'>
                          <img style='object-fit:cover' src='uploadimages/".$row['image']."'/> 
                        </div>
                        <div class='content'>
                          <div class='main'>
                            <h3 class='name'>".$row['Name'] ."</h3>

                            <p><b>IMDB: </b>".$row['imdb']."</p>

                            <p class='profession' style=' color: #8b949e!important;'><b>Genre: </b>".$row['Genre'] ."</p>

                            <p class='profession' style=' color: #8b949e!important;'><b>Director: </b> " .$row['Director'] ."</p>
                          </div>
                        </div>
                      </div>
                      <!-- end front panel -->
                      <div class='back'>
                        <div class='content'>
                          <div class='main'>
                            <h4 class='text-center'>".$row['Name'] ."</h4>
                            <p class='text-center'>".$row['Description'] ." </p>
                          </div>
                        </div>
                      </div>
                      </div> <!-- end card -->
                    </a>
                  </div> <!-- end card-container -->
                </div>";
              $count++;
            } ?>
            </div>
          </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
  </html>