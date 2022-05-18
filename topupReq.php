<?php
if (!session_id()) {
    session_start();
}
include 'db.php';

if (isset($_POST['csubmit'])) {
    $movieId = $_GET['id'];
    $request = $_POST['request'];
    $datetime = date("Y/m/d") . " on " . date("h:i a");
    $userId = $_SESSION['user'];
    $sql =  "insert into request (movieId, userId, datetime, request)
				values ($movieId, $userId, '$datetime', '$request')";
    $conn->exec($sql);
}

$res = $conn->query("select topupreq.*,user.fname,user.lname,user.email,user.accBalance from topupreq,user where user.userId =topupreq.userId;");
$requests = $res->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Topup Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/customerPanel.css">
    <link rel="stylesheet" type="text/css" href="css/topup.css">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/bootstrap-style.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppad">
                <div class="panel panel-info">
                    <h3 class="title">
                        Topup Request
                    </h3>
                    <hr style="border: 5px solid #000;">
                    <div style="margin-top: 20px;" class="panel-body">
                        <div class="row">
                            <div>
                                <?php
                                if (count($requests) >= 1) {
                                    foreach ($requests as $row) {
                                ?>
                                        <div class="requests">
                                            <div style="margin: 0 15px 0 5vw;">
                                                    <p class="user-name-a"><?php echo $row["fname"] . " " . $row["lname"]. " ( <strong> " . $row["email"]." )"; ?></strong></p>
                                                    <p class="amount-a">Topup Amount : <strong>$<?php echo $row["amount"]; ?></strong></p>
                                            </div>
                                            <div class="tooltipa accept">
                                                <span onclick='topupNow(<?php echo $row["userId"]; ?>,<?php echo $row["amount"]; ?>,<?php echo $row["tid"]; ?>)' class='icn glyphicon glyphicon-upload'></span>
                                                <span class="tooltiptext">Topup Now</span>
                                            </div>
                                        </div>
                                <?php }
                                } else {
                                    echo "<p class='no-request'>No requests to show<p>";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/topup.js"></script>
</body>

</html>