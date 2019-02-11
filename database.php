<?php
require 'db.php';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        //Tutorial search button logics
        $(document).on("click", "#searchTutorials", function(){
          var kwds = $("#kwds").val();
          var action = "loadTutorialsByKeywords";
          $("#databox").load("tutorialManipulations.php", {"keywords":kwds, "action":action});
        });
      });
    </script>
    <?php if($logged_in):?>
    <script src="js/ratingSystem.js"></script>
    <?php endif;?>
</head>

<body>
    <section id="hero">
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="index.php" style="background-size:50%;height:130px;background-image:url(&quot;none&quot;);width:130px;padding:0;margin:0px 20px;"><img src="assets/img/Logo.svg" style="width:130px;"></a><button class="navbar-toggler"
                    data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
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
        <div class="container-fluid" style="background-color:rgb(244,238,238);">
            <div id="horizontalline"><div><hr></div></div>
            <div class="row">
                <div class="col-md-4" id="searchbox" style="padding:15px;">
                  <div id="message">
                    <!-- Message text goes here -->
                  </div>
                  <div>
                      <p class="text-left" style="font-weight:600;">Enter keywords to find tutorials:</p>
                      <div class="d-flex justify-content-center align-items-center align-content-center" style="margin:auto;">
                        <input type="search" style="width:75%;height:48px;" id="kwds" />
                        <button class="btn btn-primary" type="button" style="width:25%;" id="searchTutorials"><i class="fa fa-search" style="font-size:16px;"></i></button></div>
                      <div id="horizontalline">
                          <div>
                              <hr />
                          </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-8" id="databox" style="margin:0px;padding:0px;">
                  <!-- The tutorial entries goes here. -->
                </div>
        </div>
        </div>
        <footer id="stickbottom" style="width:100%;padding:30px 0px;">
            <p class="text-center">Copyright Darius Aleksiunas<br></p>
        </footer>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</body>

</html>
