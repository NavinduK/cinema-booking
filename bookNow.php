<?php
  if (!session_id()) {
    session_start();
  }
  include_once('db.php');

  $movieId = $_REQUEST['movieId'];
  $date = $_REQUEST['movieDate'];
  $seats = $_REQUEST['seats'];
  $userId = $_SESSION['user'];

  $sql = "insert into booking (movieId,userId,date,seats) values ($movieId,$userId,'$date','$seats');";
  if($conn->exec($sql)){
      echo "1";
  }else{
    echo "0";
  }

?>