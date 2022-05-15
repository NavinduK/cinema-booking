<?php
  if (!session_id()) {
    session_start();
  }
  include_once('db.php');

  $email = $_REQUEST['postName'];
  $pass = $_REQUEST['postPassword'];

  $sql = "select userId,status from user where  email ='$email' and password='$pass';";

  $account_type = "";

  $res = $conn->query($sql);
  if (($data = $res->fetch())) {
    $_SESSION['user'] = $data['userId'];
    $account_type = $data['status'];
    if ($account_type === "101") {
      echo "1,".$data['userId']."";
    } else if ($account_type === "202") {
      echo "2,".$data['userId']."";
    }
  } else {
    echo "3";
  }

  ?>