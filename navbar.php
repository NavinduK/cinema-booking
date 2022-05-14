<style>
    .icon-bar {
        background-color: #2ca8ff;
    }

    .navbar-toggle {
        border: 1px solid #2ca8ff;

    }
</style>
<div class="navbar-wrapper">
    <div class="">

        <nav class="navbar navbar-dark bg-dark navbar-static-top" style="background-color: #222933;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class='navbar-brand' href='index.php'>Dream Cinema</a>

                </div>
                <div id="navbar" class="navbar-collapse collapse float-right">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                        <!-- <li><a href="about.php">About</a></li>
                        <li><a href="showtimes.php">Showtimes</a></li> -->

                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <?php
                            if (isset($_SESSION['user'])) {
                                $userId = $_SESSION['user'];
                                $res = $conn->query("select * from user where userId='$userId';");
                                $row = $res->fetch();
                                echo "
                                <a href='#'>
                                    <span class='glyphicon glyphicon-user'></span> " . $row['fname'] . " " . $row['lname'] . "
                                </a>";
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['user'])) {
                                $userId = $_SESSION['user'];
                                $res = $conn->query("select * from user where userId='$userId';");
                                $row = $res->fetch();
                                echo "
                                        <a href='logout.php'><span class='glyphicon glyphicon-off'></span> Logout </a>";
                            } else {
                                echo "  
                                        <a href='javascript:void(0)' onclick='openLoginModal();'><span class='glyphicon glyphicon-log-in'></span> Login </a>";
                            }
                            ?>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

    </div>
</div>