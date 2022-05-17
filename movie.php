<?php
if (!session_id()) {
	session_start();
}
include 'db.php';

if (isset($_POST['csubmit'])) {
	$movieId = $_GET['id'];
	$comment = $_POST['comment'];
	$datetime = date("Y/m/d") . " on " . date("h:i a");
	$userId = $_SESSION['user'];
	$sql =  "insert into comment (movieId, userId, datetime, comment)
				values ($movieId, $userId, '$datetime', '$comment')";
	$conn->exec($sql);
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ticket</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/customerPanel.css">
	<link rel="stylesheet" type="text/css" href="css/dark.css">
	<link rel="stylesheet" type="text/css" href="css/rating.css">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/bootstrap-style.css" rel="stylesheet">

	<style type="text/css">
		.boxStyle {
			width: 100%;
			border: 1px solid #384250;
			background: #242b34;
			margin: 0 0 5px;
			padding: 10px;
			font-style: normal;
			font-variant-ligatures: normal;
			font-variant-caps: normal;
			font-variant-numeric: normal;
			font-weight: 400;
			font-stretch: normal;
			font-size: 12px;
			line-height: 16px;
			font-family: Roboto, Helvetica, Arial, sans-serif;
		}
	</style>
</head>

<body>
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 toppad">
				<div class="panel panel-info">
					<h3 class="title">
						<?php
						$movieId = $_GET['id'];
						$res = $conn->query("select * from movielist where movieId=$movieId;");
						$row = $res->fetch();

						echo "" . $row['Name']; ?>
					</h3>
					<hr style="border: 5px solid #000;">
					<div style="margin-top: 20px;" class="panel-body">
						<div class="row">
							<div class="col-md-5 col-lg-5 " align="center">
								<img alt="User Pic" src=<?php echo '"uploadimages/' . $row['image'] . '"'; ?> class=" img-responsive">
							</div>
							<div class=" col-md-7 col-lg-7 ">
								<table class="table table-user-information">
									<tbody>
										<tr>
											<td><strong>Genre</strong></td>
											<td> <?php echo "" . $row['Genre']; ?> </td>
										</tr>
										<tr>
											<td><strong>Director</strong></td>
											<td><?php echo "" . $row['Director']; ?> </td>
										</tr>
										<tr>
										<tr>
											<td><strong>IMDB</strong></td>
											<td><?php echo "" . $row['imdb']; ?> </td>
										</tr>
										<tr>
											<td><strong>Description</strong></td>
											<td><?php echo "" . $row['Description'];	?> </td>
										</tr>
										<tr>
											<td><strong>Show Time</strong></td>
											<td><?php echo "" . $row['showTime']; ?> </td>
										</tr>
										<?php if ($row['catagory'] == 'now') { ?>
											<form action="booking.php" method="post">
												<tr>
													<td><strong>Date</strong></td>
													<td><input id="datePickerId" required class="boxStyle" type="date" name="date"></td>
												</tr>
												<tr>
													<td colspan="2" width="100%">
														<input value=<?php echo "'" . $row['movieId'] . "'"; ?> type="hidden" name="id">
														<input style="height: 40px" class="btn btn-primary btn-xs btn-block" type="submit" name="submit" value="Book a Ticket">
													</td>
												</tr>
											</form>
										<?php } else { ?>
											<tr style="text-align: center;">
												<td colspan="2">
													<h2 style="color: #2ca8ff;">Coming Soon on Dream Cinema</h2>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<?php if ($row['catagory'] == 'now') { ?>
						<div class="panel panel-info">
							<hr style="border: 5px solid #000;">
							<h3 class="title">
								Rating and Comments
							</h3>
							<hr style="border: 5px solid #000;">
							<div class="panel-body">
								<div class="row ratingsec">
									<div class="ratingbody">
										<div class=" col-md-4 col-lg-4 col-sm-4 col-xs-6">
											<h5 style="margin: 8px 0; text-align:center; color: #3472F7;">CINEMA RATING</h5>
											<div class="container-r">
												<h2 style="margin:0;font-size: 40px;">
													<?php
													$stmt = $conn->query("select avg(rating) as 'rating' from rating where movieId=$movieId;");
													$rating = $stmt->fetch();
													if ($rating)
														echo round($rating['rating'], 1);
													else
														echo 0;
													?>
												</h2>
												<h6 style="margin: 20px 0 0 5px; ">out of 5</h6>
											</div>

										</div>
										<div class=" col-md-4 col-lg-4 col-sm-4 col-xs-6">
											<h5 style="margin: 8px 0; text-align:center; color: #3472F7;">RATED COUNT</h5>
											<div class="container-r">
												<h2 style="margin:0; font-size: 40px;">
													<?php
													$stmt = $conn->query("select count(rating) as 'count' from rating where movieId=$movieId;");
													$rating = $stmt->fetch();
													if ($rating)
														echo $rating['count'];
													else
														echo 0;
													?>
												</h2>
												<h6 style="margin: 20px 0 0 5px; ">Ratings</h6>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
											<h5 style="margin: 8px 0; text-align:center; color: #3472F7;">CLICK TO RATE</h5>
											<div class="container-r">
												<div class="feedback">
													<?php
													if (isset($_SESSION['user'])) {
														$movieId = $_GET['id'];
														$userId = $_SESSION['user'];
														$res = $conn->query("select * from booking where movieId=$movieId and userId=$userId;");
														$row = $res->fetchAll(PDO::FETCH_ASSOC);
														if (count($row) >= 1) {
															$res2 = $conn->query("select * from rating where movieId=$movieId and userId=$userId;");
															$row2 = $res2->fetch();
															if (!$row2) {
													?>
																<div class="rating">
																	<input onchange="ratinghandler(this,<?php echo $movieId; ?>);" type="radio" name="rating" value="5" id="rating-5">
																	<label for="rating-5"></label>
																	<input onchange="ratinghandler(this,<?php echo $movieId; ?>);" type="radio" name="rating" value="4" id="rating-4">
																	<label for="rating-4"></label>
																	<input onchange="ratinghandler(this,<?php echo $movieId; ?>);" type="radio" name="rating" value="3" id="rating-3">
																	<label for="rating-3"></label>
																	<input onchange="ratinghandler(this,<?php echo $movieId; ?>);" type="radio" name="rating" value="2" id="rating-2">
																	<label for="rating-2"></label>
																	<input onchange="ratinghandler(this,<?php echo $movieId; ?>);" type="radio" name="rating" value="1" id="rating-1">
																	<label for="rating-1"></label>
																</div>
															<?php
															} else {
															?>
																<div class="rating-d">
																	<input disabled type="radio" name="rating" value="5" id="rating-5" <?php if ($row2['rating'] == 5) echo 'checked'; ?>>
																	<label for="rating-5"></label>
																	<input disabled type="radio" name="rating" value="4" id="rating-4" <?php if ($row2['rating'] == 4) echo 'checked'; ?>>
																	<label for="rating-4"></label>
																	<input disabled type="radio" name="rating" value="3" id="rating-3" <?php if ($row2['rating'] == 3) echo 'checked'; ?>>
																	<label for="rating-3"></label>
																	<input disabled type="radio" name="rating" value="2" id="rating-2" <?php if ($row2['rating'] == 2) echo 'checked'; ?>>
																	<label for="rating-2"></label>
																	<input disabled type="radio" name="rating" value="1" id="rating-1" <?php if ($row2['rating'] == 1) echo 'checked'; ?>>
																	<label for="rating-1"></label>
																</div>
													<?php
															}
														} else {
															echo '<p style="margin:0;; text-align:center;">Book a ticket to rate this movie</p>';
														}
													} else {
														echo '<p style="margin:0;; text-align:center;">Login to rate this movie</p>';
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								if (isset($_SESSION['user'])) {
									$movieId = $_GET['id'];
									$userId = $_SESSION['user'];
									$res = $conn->query("select * from booking where movieId=$movieId and userId=$userId;");
									$row = $res->fetchAll(PDO::FETCH_ASSOC);
									if (count($row) >= 1) {
								?>
										<div class="row">
											<div class="comment-q">
												<form action="movie.php?id=<?php echo $_GET['id'] ?>" method="POST">
													<div class="title">
														<h5 style="margin: 8px 0; text-align:center; color: #3472F7;">LEAVE A COMMENT</h5>
														<textarea maxlength="150" rows="2" name="comment" placeholder="Enter your comment here..." required></textarea>
													</div>
													<input type="submit" name="csubmit" value="Post Your Comment" class="comment-b">
												</form>
											</div>
										</div>
								<?php
									}
								}
								?>
								<div class="row">
									<div>
										<h5 style="margin: 30px 0 -20px 0; text-align:center; color: #3472F7;">COMMENTS BY VIEWRS</h5>
										<?php
										$sqlQ =  $conn->query("select comment.*, user.fname, user.lname from comment,user where user.userId =comment.userId and comment.movieId=$movieId");
										$comments = $sqlQ->fetchAll(PDO::FETCH_ASSOC);
										if (count($comments) >= 1) {
											foreach ($comments as $row) {
										?>
												<div class="comments">
													<div class="row" style="margin: 10px 15px 0 15px;">
														<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
															<p class="user-name-a"><?php echo $row["fname"] . " " . $row["lname"]; ?></p>
														</div>
														<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
															<p style="float: right;" class="post-date-a"><?php echo $row["datetime"]; ?></p>
														</div>
													</div>
													<div class="row">
														<hr style="border:none ;height: 3px; background:#161b22; margin-top:10px">
														<p style=" margin: 0 40px 20px 40px; text-align:center"><?php echo $row["comment"]; ?></p>
													</div>
												</div>
										<?php }
										} else {
											echo "<p class='no-comment'>No comments to show<p>";
										} ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>
	<?php include_once 'footer.php'; ?>
	<script src="./js/movie.js"></script>

</body>

</html>