<?php
    if (!session_id()) {
        session_start();
    }
    include 'db.php';
	$rating = $_POST['rating'];
    $movieId = $_POST['movieId'];
    $userId = $_SESSION['user'];

    $sql = "insert into rating (movieId,userId,rating) values ($movieId,$userId,$rating);";
    if($conn->exec($sql)){
        echo "1";
    }else{
        echo "0";
    }
    
?>