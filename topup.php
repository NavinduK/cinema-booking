<?php
include 'db.php';
if (!session_id()) {
    session_start();
}
if (isset($_POST['submit'])) {
    $cardNo = $_POST['cardNo'];
    $expDate = $_POST['expDate'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['amount'];
    $userId = $_SESSION['user'];
    $sql = "insert into topupreq(userId,amount,cardNo,expDate,cvv) 
		values ($userId,$amount,'$cardNo','$expDate','$cvv');";
    if ($conn->exec($sql)) {
        header("Location: index.php");
    }else{
        echo "<script>alert('Error occured');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Movie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/topup.css">
    <link rel="stylesheet" type="text/css" href="css/customerPanel.css">
    <link href="css/bootstrap-style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <style type="text/css">
        body,
        html {
            height: 100%;
            margin: 0;
        }
        .boxStyle, .boxStyle-2{
            text-align: center;
        }
        .wrapper {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include_once "navbar.php"; ?>
    <div style="margin: 100px auto 0 auto;" class="container">
        <div style="margin: 0 ;" class="row">
            <div class=" toppad">
                <div class="panel panel-info toppad">
                    <div class="container-r">
                        <div>
                            <h3 class="title" style="margin:0; text-align: center;">Topup Credit</h3>
                            <hr style="border: 5px solid #000;">
                            <form style="margin:60px 0;" id="contact" action="topup.php" method="post">
                                <input class="boxStyle" name="cardNo" placeholder="Credit Card No" type="text" required >
                                <div>
                                    <div style="display: flex;justify-content: right;" class="in-c col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                        <input class="boxStyle-2" style="padding: 10px; width:185px;margin:0 auto" type="text" name="cvv" placeholder="CVV" required >
                                    </div>
                                    <div style="display: flex;justify-content: left;" class="in-c col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                        <input class="boxStyle-2" style="padding: 10px; width:185px" name="expDate" placeholder="Expiry Date" type="Date" required>
                                    </div>
                                </div>
								<input class="boxStyle" style="width:185px" name="amount" placeholder="Amount" type="text"required >
                                <div class="button-class">
                                    <input class="boxStyle" style="font-size: larger;" type="submit" name="submit" value="Pay Now">
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