<?php
session_start();
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
                      <?php if($logged_in):?>
                        <li class="nav-item" role="presentation" style="margin:0;"><a class="nav-link active" href="profile.php" style="padding:8px;margin:15px;font-size:20px;color:#000000;font-family:Montserrat, sans-serif;font-weight:600;">PROFILE</a></li>
                      <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron" style="background-color:rgb(244,238,238);">
            <h1 class="text-center" style="font-size:26px;"><strong>An application for finding the best suitable programming and&nbsp;digital art tutorials</strong><br></h1>
            <p class="lead text-left" style="margin:50px 0px 35px 0px;">This webpage is suited for people interested in programming and digital art learning. Here you can search for desirable tutorials and sort them by other users rating. The purpose of such a dedicated tutorial database is to make a convenient
                way to find a quality tutorial with reviews in a much shorter time.<br></p>
            <p class="text-center text-info"><br>To enter the database search page and start searching just press the&nbsp;<strong>START&nbsp;</strong>button.<br><br></p>
            <p class="text-center" style="margin:0;"><a class="btn btn-primary" style="background-color:rgb(31,155,207);" role="button" href="database.php">start</a></p>
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
