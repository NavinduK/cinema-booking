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

$userId = $_SESSION['user'];
$res = $conn->query("select * from user where userId='$userId';");
$userData = $res->fetch();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Ticket</title>
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
                                    if (isset($userData['image']))
                                        echo '"profileimages/' . $userData['image'] . '"';
                                    else
                                        echo 'images/profile.jpg';
                                ?> class="img-responsive">
                            </div>
                            <div class=" col-md-7 col-lg-7 ">
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
                                                <input disabled id="password-u" class="boxStyle" value="********" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Password</strong></td>
                                            <td><span id="e-password" class='icn glyphicon glyphicon-edit'></span></td>
                                            <td>
                                                <input disabled id="image-u" class="boxStyle" value="Click to edit" type="file">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input style="height: 40px" class="btn btn-primary btn-xs btn-block" type="submit" name="submit" value="Update Profile">
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