<?php
include 'db.php';
if (!session_id()) {
	session_start();
}
if (!(($_SESSION['admin']) == 1)) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/adminpage.css" rel="stylesheet">
	<link href="css/rotating-card.css" rel="stylesheet">
	<link href="css/bootstrap-style.css" rel="stylesheet">
	<link href="css/dark.css" rel="stylesheet">
</head>

<body style="background: #efc0c0">
	<?php include 'navbar.php'; ?>
	<div style="margin: 100px auto 80px auto;" class="container">
		<div class="admin row" style="text-align:center">
			<h3 style="margin-bottom: 50px">Admin Controls</h3>
			<div class="btn-tp col-md-6">
				<a style="width: 100%;" href="addMovie.php" class="myButton">Add Movie</a>
			</div>
			<div class="btn-btm col-md-6">
				<a style="width: 100%;" href="addtheater.php" class="myButton">View Topups</a>
			</div>
			</div>
		</div>
	</div>
	<hr style="border:2px solid #222933;">
	<h3 style=" text-align:center;margin-bottom: 50px">Movies in the System</h3>
	<div style="margin: 20px auto;" class="container">
		<div class="tab-content">
			<div class="tab-pane fade in active" id="nowshowing">
				<?php include 'movieList.php' ?>
			</div>
		</div>
	</div>
</div>
	<?php include 'footer.php'; ?>
</body>

</html>