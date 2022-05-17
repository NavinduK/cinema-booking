<?php
include 'db.php';
if (!session_id()) {
	session_start();
}
if (!(($_SESSION['admin'])==1)) {
	header('Location: index.php');
}
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$genre = $_POST['genre'];
	$imdb = $_POST['imdb'];
	$director = $_POST['director'];
	$showTime = $_POST['showTime'];
	$catagory = $_POST['catagory'];
	$description = $_POST['description'];

	$target = "uploadimages/" . basename($_FILES['image']['name']);
	$image = $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$sql = "insert into movielist(Name,Genre,Director,Description,image,imdb,showTime,catagory) 
		values ('$name','$genre','$director','$description','$image','$imdb','$showTime','$catagory');";
	if ($conn->exec($sql)) {
		if (move_uploaded_file($image_tmp, $target)) {
			echo "<script>alert('Movie Successfully Added');</script>";
		} else {
			echo "<script>alert('Movie failed to add');</script>";
		}
	}
	header("Location: adminpage.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/addmovie.css">
	<link rel="stylesheet" type="text/css" href="css/customerPanel.css">
	<link href="css/bootstrap-style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<style type="text/css">
		body,
		html {
			height: 100%;
			margin: 0;
		}

		.wrapper {
			text-align: center;
		}
	</style>
</head>

<body>
	<?php include_once "navbar.php"; ?>
	<div style="margin-top: 50px;" class="container">
		<div class="row">
			<div class=" toppad">
				<div class="panel panel-info toppad">
					<div class="container-r">
						<div>
							<h3 class="title" style="margin:0; text-align: center;">Add Movie</h3>
							<hr style="border: 5px solid #000;">
							<form id="contact" action="addMovie.php" method="post" enctype="multipart/form-data">
								<input class="boxStyle" name="name" placeholder="Movie Name" type="text" tabindex="1" required autofocus>
								<select class="boxStyle MovieGenre" name="genre" required>
									<option value="Action">Action</option>
									<option value="Adventure">Adventure</option>
									<option value="Horror">Horror</option>
									<option value="Sci-fi">Sci-fi</option>
									<option value="Comedy">Comedy</option>
									<option value="Crime">Crime</option>
									<option value="Romance">Romance</option>
									<option value="Drama">Drama</option>
								</select>
								<input name="imdb" placeholder="IMDB rating" type="text" tabindex="1" required>
								<input name="director" placeholder="Director" type="text" tabindex="1" required>
								<textarea name="description" placeholder="Description" type="textArea" tabindex="1" required></textarea>
								<select class="MovieGenre" name="catagory">
									<option selected="selected" value="now">Show Now</option>
									<option value="upcoming">Upcoming</option>
								</select>
								<div>
								<div style="display: flex;justify-content: right;" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
									<input style="padding: 10px; width:200px;margin:0 auto" type="file" name="image" required autofocus>
								</div>
								<div style="display: flex;justify-content: left;" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
									<input style="padding: 10px; width:200px" name="showTime" placeholder="Show Time" type="time" required>
								</div>
								</div>
								<div class="button-class">
									<input style="font-size: larger;" class="MovieGenre" type="submit" name="submit">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>