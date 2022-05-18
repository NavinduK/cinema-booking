<?php
  if (!session_id()) {
    session_start();
  }
  include_once('db.php');

  $fname = $_REQUEST['fname'];
  $lname = $_REQUEST['lname'];
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $userId = $_SESSION['user'];

  $sql = "update user set fname='$fname', lname='$lname', email='$email', password='$password' where userId=$userId;";
  if($conn->exec($sql)){
      echo "1";
  }else{
    echo "0";
  }

?>