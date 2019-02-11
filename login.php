<?php
require 'db.php';
session_start();
/* Alert message variables*/
$_SESSION['message'] = null;
$show_alert = false;
/* Login check*/
$logged_in = false;
if(isset($_SESSION['logged_in'])  //if variable exists
  && $_SESSION['logged_in']==true //if variable is true
  && $_SESSION['active'] = 1){    //if account is active
  $logged_in = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorialDatabase</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){//Waits for website to POST details
    if (isset($_POST['login'])) {//User login
        require 'loginlogics.php';
        $show_alert = true;
        if(isset($_SESSION['logged_in'])){//check if login variable exists
          $logged_in = $_SESSION['logged_in'];
        }
    }
}
?>
<body>
    <section id="hero">
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="index.php" style="background-size:50%;height:130px;background-image:url(&quot;none&quot;);width:130px;padding:0;margin:0px 20px;"><img src="assets/img/Logo.svg" style="width:130px;"></a><button class="navbar-toggler"
                    data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                      <li class="nav-item" role="presentation" style="margin:0;"><a class="nav-link active" href="database.php" style="padding:8px;margin:15px;font-size:20px;color:rgb(31,155,207);font-family:Montserrat, sans-serif;font-weight:600;">DATABASE</a></li>
                      <?php if(!$logged_in):?>
                        <li class="nav-item" role="presentation" style="margin:0;"><a class="nav-link active" href="signup.php" style="padding:8px;margin:15px;font-size:20px;color:#000000;font-family:Montserrat, sans-serif;font-weight:600;">SIGN UP</a></li>
                        <li class="nav-item" role="presentation" style="margin:0;"><a class="nav-link active" href="login.php" style="padding:8px;margin:15px;font-size:20px;color:#000000;font-family:Montserrat, sans-serif;font-weight:600;">LOGIN</a></li>
                      <?php endif;?>
                      <li class="nav-item" role="presentation" style="margin:0;"><a class="nav-link active" href="contactus.php" style="padding:8px;margin:15px;font-size:20px;color:#000000;font-family:Montserrat, sans-serif;font-weight:600;">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron" style="background-color:rgb(244,238,238);">
            <h1 class="text-center" style="font-size:30px;margin:0px 0px 20px;"><strong>Login</strong><br></h1>
            <div id="horizontalline"><div><hr></div></div>
            <?php if($show_alert):?>
              <div class="alert alert-info" style="width:250px;margin:auto;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= $_SESSION['message']?>
              </div>
            <?php endif;?>
            <form method="post">
                <p class="text-center" style="margin:16px 0px 0px;"><label class="d-block" style="margin:auto;">Enter Your Email</label></p>
                <div class="d-flex"><input type="email" class="form-control" placeholder="name@email.com" required="" style="width:250px;margin:auto;" name="email" /></div>
                <p class="text-center" style="margin:16px 0px 0px;"><label class="d-block" style="margin:auto;">Enter Your Password</label></p>
                <div class="d-flex" style="margin:auto;"><input class="form-control d-block" type="password" required="" placeholder="Password" style="margin:auto;width:250px;"name="password"></div>
                <p class="text-center" style="margin:16px 0px 0px;"><a href="forgot.php"><label class="d-block" style="margin:auto;">Forgot Your Password?</label></a></p>
                <div class="d-block" style="margin:auto;width:200px;">
                    <p class="text-center" style="margin:0;"><button class="btn btn-primary" type="submit" style="margin:30px;" name="login">Login</button></p>
                </div>
            </form>
        </div>
        <footer id="stickbottom" style="width:100%;">
            <p class="text-center">Copyright Darius Aleksiunas<br></p>
        </footer>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</body>

</html>
