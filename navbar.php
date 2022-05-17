<style>
    .icon-bar {
        background-color: #2ca8ff;
    }

    .navbar-toggle {
        border: 1px solid #2ca8ff;
    }
</style>

<div class="navbar-wrapper">
    <div>

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
                                if ($_SESSION['admin']==1) {
                                    echo "
                                    <a href='adminpage.php'>
                                        <span class='glyphicon glyphicon-tasks'></span> Admin Dashboard
                                    </a>";
                                }else{
                                    echo "
                                    <a href='profile.php'>
                                        <span class='glyphicon glyphicon-user'></span> " . $row['fname'] . " " . $row['lname'] . "
                                    </a>";
                                }
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
                                        <a href='logout.php' onclick='return logout()'><span class='glyphicon glyphicon-off'></span> Logout </a>";
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

<div class="modal fade login" id="loginModal">
      <div class="modal-dialog modal-dialog-centered login animated">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Login</h4>
          </div>

          <div class="modal-body">  
            <div class="box">
              <div class="content">

                <div class="error"></div>
                <div class="form loginBox">
                  <form method="post" action="index.php" accept-charset="UTF-8">
                    <input required id="userName" class="form-control" type="text" placeholder="Username" name="Username">
                    <input required id="password" class="form-control" type="password" placeholder="Password" name="password">
                    <input class="btn btn-default btn-login" type="button" value="Login" onclick="loginAjax()">
                  </form>
                </div>
              </div>
            </div>

            <div class="box" id="RegistrationBox">
              <div class="content registerBox" style="display:none;">
                <div class="form">
                  <form method="post" html="{:multipart=>true}" data-remote="true" action="index.php" accept-charset="UTF-8">
                    <input id="fname" class="form-control" type="text" placeholder="First Name" name="fname">
                    <input id="lname" class="form-control" type="text" placeholder="Last Name" name="lname">
                    <input id="regEmail" class="form-control" type="email" placeholder="Email" name="email"
                        pattern="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/">
                    <input id="regPassword" class="form-control" type="password" placeholder="Password" name="password">
                    <input id="regPassword_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                    <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit" onclick=" RegistrationAjax(event)">
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
              <div class="forgot login-footer">
                <span>Don't have an account?
                  <a href="javascript: showRegisterForm();">Create an Account</a>
                </span>
              </div>
              <div class="forgot register-footer" style="display:none">
                <span>Already have an account?</span>
                <a href="javascript: showLoginForm();">Login</a>
              </div>
          </div>        
        </div>
      </div>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
    <script src="js/main.js"></script>
    <link href="css/dark.css" rel="stylesheet">
