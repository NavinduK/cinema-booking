<?php
if (!session_id()) {
  session_start();
}
include_once('db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dream Cinema</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="#">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/rotating-card.css" rel="stylesheet">
  <link href="css/bootstrap-style.css" rel="stylesheet">
</head>

<body>
  <?php include 'navbar.php'; ?>

  <div style="margin-top: 70px" class="container">
    <div class="tab-content">
      <div class="tab-pane fade in active" id="nowshowing">
        <?php include 'movieList.php' ?>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>