<?php
  if (!session_id()) {
    session_start();
  }
  include_once('db.php');

  $userId = $_REQUEST['userId'];
  $amount = $_REQUEST['amount'];
  $tid = $_REQUEST['topupId'];

  $sql1 = "update user set accBalance=accBalance+$amount where userId=$userId;";
  $sql2 = "delete from topupreq where tid=$tid;";
  if($conn->exec($sql1) && $conn->exec($sql2)){
      echo "1";
  }else{
    echo "0";
  }

?>