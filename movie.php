<?php
if (!session_id()) {
	session_start();
}
include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Ticket</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/customerPanel.css">
	<link rel="stylesheet" type="text/css" href="css/dark.css">
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />

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
			<div class="col-xs-12  toppad">
				<div class="panel panel-info">
					<h3 class="title">
						<?php
						$movieId = $_GET['id'];
						$_SESSION['movieId'] = $movieId;
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
													<td><input required class="boxStyle" type="date" name="date"></td>
												</tr>
												<tr>
													<td colspan="2" width="100%">
														<input value=<?php echo "'". $row['movieId']."'"; ?> type="hidden" name="id">
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
				</div>
			</div>

		</div>

	</div>
</body>

</html>