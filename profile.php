<?php
if (!session_id()) {
    session_start();
}
include 'db.php';
$userId = $_SESSION['user'];

if (isset($_FILES['image'])) {
    echo "<script>alert('Received');</script>";

	$target = "profileImages/" . basename($_FILES['image']['name']);
	$image = $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$sql = "update user set image ='$image' where userId=$userId;";
	if ($conn->exec($sql)) {
		if (move_uploaded_file($image_tmp, $target)) {
			echo "<script>alert('Profile Image Successfully Added');</script>";
		} else {
			echo "<script>alert('Profile Image failed to add');</script>";
		}
	}
}

$res = $conn->query("select * from user where userId='$userId';");
$userData = $res->fetch();
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/customerPanel.css">
    <link rel="stylesheet" type="text/css" href="css/dark.css">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/bootstrap-style.css" rel="stylesheet">

    <style type="text/css">
        .boxStyle {
            width: 100%;
            border: 1px solid #384250;
            background: #242b34;
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
        input:disabled{
            background-color: #161b22!important;
            border: none;
        }
        .icn{
            color: #3472F7;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <div  style="margin: 100px auto 10px auto!important;" class="container">
        <div class="row">
            <div class="col-xs-12 toppad">
                <div class="panel panel-info">
                    <h3 class="title">
                        <?php echo "" . $userData['fname'] . " " . $userData['lname']; ?>
                    </h3>
                    <hr style="border: 5px solid #000;">
                    <div style="margin: 50px 0;" class="panel-body">
                        <div class="row">
                            <div class="col-md-5 col-lg-5 " align="center">
                                <img width="275px" alt="User Pic" src=<?php
                                    if (!is_null($userData['image']))
                                        echo '"profileimages/' . $userData['image'] . '"';
                                    else
                                        echo 'images/profile.jpg';
                                ?> class="img-responsive">
                                <form id="profilePic" action="profile.php" method="post" enctype="multipart/form-data">
                                    <div style="width: 100%; display: flex; justify-content:right; margin:10px 0;" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                        <input accept="image/*" onchange="submitForm()" style="padding: 10px; width:200px; margin:0 auto" type="file" name="image" required>
                                    </div>
							    </form>
                            </div>
                            <div style="margin-top: 20px!important;" class=" col-md-7 col-lg-7 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td width="100px"><strong>First name</strong></td>
                                            <td ><span id="e-fname" class='icn glyphicon glyphicon-edit'></span></td>
                                            <td>
                                                <input disabled id="fname-u" class="boxStyle" value="<?php echo $userData['fname']; ?>" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Last name</strong></td>
                                            <td><span id="e-lname" class='icn glyphicon glyphicon-edit'></span></td>
                                            <td>
                                                <input disabled id="lname-u" class="boxStyle" value="<?php echo $userData['lname']; ?>" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><span id="e-email" class='icn glyphicon glyphicon-edit'></span></td>
                                            <td>
                                                <input disabled id="email-u" class="boxStyle" value="<?php echo $userData['email']; ?>" type="email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Password</strong></td>
                                            <td><span id="e-password" class='icn glyphicon glyphicon-edit'></span></td>
                                            <td>
                                                <input disabled id="password-u" class="boxStyle" value=<?php echo $userData['password']; ?> type="password">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input id="updateP" style="height: 40px" class="btn btn-primary btn-xs btn-block" type="submit" name="submit" value="Update Profile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
	<script src="./js/profile.js"></script>
</body>

</html>