<?php
require 'db.php';
include 'util/TutorialUtils.php';
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
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/TD-BS4-Simple-Contact-Form-1.css">
    <link rel="stylesheet" href="assets/css/TD-BS4-Simple-Contact-Form.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Hiding admin script from clients -->
    <?php if($_SESSION['admin']==1):?>
    <script>
    $(document).ready(function(){
      $(document).on("click",".btn", function(event) {
        var targetid = event.target.id;//Stores clicked button id
        if(targetid == "pendingentries"){//If clicked pending entries button, loads pending entries
          var action = "loadPendingTutorials";
          $("#tutorials").load("tutorialManipulations.php", {"action":action});
        }
        else if(targetid == "allentries"){//If clicked confirmed entries button, loads confirmed entries
          var action = "loadConfirmedTutorials";
          $("#tutorials").load("tutorialManipulations.php", {"action":action});
        }
        else if(targetid.substr(0, 4)=="acpt" || targetid.substr(0, 4)=="deny"){
          var linkid = targetid.slice(4);//Stores link id
          var action = targetid.substr(0, 4);//Stores accept or deny tutorial
          var link = $("#"+linkid).attr('href');//Stores the link address of tutorial
          $("#tutorials").load("tutorialManipulations.php", {"link":link, "action":action});
        }
      });
    });
    </script>
    <?php endif;?>
    <!-- Including rating system script -->
    <script src="js/ratingSystem.js"></script>
</head>
<?php
//Logout logics
if (isset($_GET['logoutsession'])){//user logging out
  session_unset();
  session_destroy();
  $logged_in=false;
  header("location: index.php");
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
        <div class="container-fluid" style="background-color:rgb(244,238,238);">
            <div id="horizontalline"><div><hr></div></div>
            <div class="row">
                <div class="col-md-4" id="searchbox" style="padding:15px;">
                    <div>
                        <div class="d-block" style="width:100%;margin:auto;">
                          <a class="btn btn-primary" role="button" href="submittutorial.php" style="margin:0px 0px 10px 0px;width:100%;padding:15px;">SUBMIT NEW TUTORIAL</a>
                        </div>
                        <!-- If logged in as an admin, can approve pending entries or remove already approved entries -->
                        <?php if($_SESSION['admin']==1):?>
                        <div class="d-block" style="width:100%;margin:auto;">
                          <a class="btn btn-primary" role="button" href="#" style="margin:0px 0px 10px 0px;width:100%;padding:15px;" id="pendingentries">PENDING ENTRIES</a>
                        </div>
                        <div class="d-block" style="width:100%;margin:auto;">
                          <a class="btn btn-primary" role="button" href="#" style="margin:0px 0px 10px 0px;width:100%;padding:15px;" id="allentries">CONFIRMED TUTORIALS</a>
                        </div>
                        <?php endif;?>
                        <div class="d-block" style="width:100%;margin:auto;">
                          <a class="btn btn-danger" role="button" href="?logoutsession" style="margin:0px 0px 10px 0px;width:100%;padding:15px;">LOGOUT</a>
                        </div>
                    </div>
                    <div id="horizontalline"><div><hr></div></div>
                </div>
                <div class="col-md-8" id="databox" style="margin:0px;padding:0px;">
                    <!-- Hides explanation colour bar if admin. -->
                    <?php if($_SESSION['admin']==0):?>
                    <div class="justify-content-center align-items-start align-self-stretch" id="tutorialentry" style="padding:15px;height:auto;">
                        <div class="row justify-content-center align-items-center" style="border-style: solid;border-width: 4px 0px 4px 0px;border-color: black;">
                            <div class="col-6" style="background-color:rgb(75,191,115);">
                                <p class="text-center text-light" style="margin:16px 0px;">Accepted</p>
                            </div>
                            <div class="col-6" style="background-color:rgb(31,155,207);">
                                <p class="text-center text-light" style="margin:16px 0px;">Pending</p>
                            </div>
                        </div>
                        <div id="horizontalline"><div><hr></div></div>
                      </div>
                    <?php endif;?>

                    <!-- All tutorial entries goes here. -->
                      <div id="tutorials">
                        <?php
                          if($_SESSION['admin']==1){
                            echo '<h1><p class="text-center" style="height:4px;text-transform:capitalize;">Hello admin!</p></h1>';
                            // If logged in as admin, load pending tutorials.
                          }
                          elseif ($_SESSION['admin']==0) {
                            // If logged in as client, load private tutorials.
                            $tutorialUtils = new TutorialUtils;
                            $tutorialUtils->loadClientTutorials();
                          }
                        ?>
                      </div>
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
