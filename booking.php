<?php
if (!session_id()) {
  session_start();
}
include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="css/booking.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Movie Seat Booking</title>
</head>

<body>
  <?php include_once 'navbar.php'; ?>
  <?php
  echo "<script>localStorage.removeItem('selectedSeats')</script>";
  $movieId = $_POST['id'];
  $date = $_POST['date'];
  // $user = $_SESSION['user'];
  $stmt = $conn->query("select * from booking where movieId=$movieId and date='$date';");
  $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if ($res) {
    $seats = "[";
    foreach ($res as $row) {
      $seats = $seats . $row['seats'] . ",";
    }
    $seats = $seats . "]";
    echo "<script>localStorage.setItem('selectedSeats',JSON.stringify(" . $seats . "))</script>";
  }
  ?>
  <div class="body">
    <div class="text-center">
      <h3 id="movieName" class="title">
        <?php
        $res = $conn->query("select * from movielist where movieId=$movieId;");
        $row = $res->fetch();
        echo "" . $row['Name'];
        ?>
      </h3>
      <div style="background-color: #fff; margin:0 auto;width:180px;color:#000;padding:5px;border-radius: 5px;">
          <span id="movieDate"><?php echo $date; ?></span> <span> at <?php echo $row['showTime']; ?> </span>
      </div>
      <p style="margin:10px auto 20px auto;width:180px;">(Ticket Price: $20)</p>
    </div>
    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>Available</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat occupied"></div>
        <small>Occupied</small>
      </li>
    </ul>

    <div class="container-b">
      <div class="screen"></div>

      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
      </div>
    </div>

    <p class="text">
      You have selected <span id="count">0</span> seats for a price of $<span id="total">0</span>
    </p>
    <button id="booknow" style="background-color: #6feaf6; margin:10px auto; width:180px;color:#000;padding:5px;border:none;border-radius: 5px;">
      Book Now
    </button>
  </div>

  <script src="./js/script.js"></script>
</body>

</html>