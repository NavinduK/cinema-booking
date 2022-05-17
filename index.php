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
  <link href="css/bootstrap-style.css" rel="stylesheet">
  <link href="css/dark.css" rel="stylesheet">
  <link href="css/anotherDefault.css" rel="stylesheet">
</head>

<body>
  <!-- NAVBAR  -->
  <?php include 'navbar.php'; ?>
  <?php include 'carousel.php'; ?>

  <?php
  if (!empty($_GET['msg'])) {
    echo "
      <p style='font-family: cursive; text-align: center; color: #5c865c; font-size: 2vw;'>" . $_GET['msg'] . "</p>
      ";
  }
  ?>

  <div class="container">
    <div class="tab-content">
      <div class="tab-pane fade in active" id="nowshowing">
        <?php include 'movieList.php' ?>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>