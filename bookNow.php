<?php
  if (!session_id()) {
    session_start();
  }
  include_once('db.php');

  $movieId = $_REQUEST['movieId'];
  $date = $_REQUEST['movieDate'];
  $seats = $_REQUEST['seats'];
  $total = $_REQUEST['total'];
  $userId = $_SESSION['user'];

  $sql1 = "insert into booking (movieId,userId,date,seats) values ($movieId,$userId,'$date','$seats');";  
  $sql2 = "update user set accBalance=accBalance-$total where userId=$userId;";

  if($conn->exec($sql1) && $conn->exec($sql2)){
      echo "1";
  }else{
    echo "0";
  }

?>