<?php
    if (!session_id()) {
        session_start();
    }
    include_once ('db.php');

    $email=$_REQUEST['email'];
    $pass=$_REQUEST['password'];
    $fname=$_REQUEST['fname'];
    $lname=$_REQUEST['lname'];

    if ($email=="" || $pass=="") {
        echo "0";
    }else{
        $emailUnique=true;
        $sql="select email from user where email = '$email';";
        $res=$conn->query($sql);
        if (!$res) {
            echo "1";
        }else{
            $sql2="insert into user(email, password, status, fname, lname) values('$email','$pass',202,'$fname','$lname');";
            $conn->exec($sql2);
            echo "2";
        }
    }
?>