<?php
require 'db.php';
session_start();
//Checking if email and email and hash variables are set and not empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);
    //Selecting user with certain email that is not active yet
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");
    if ( $result->num_rows == 0 ){//If account has been activated then throw a message
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
        header("location: signup.php");
    }
    else {
        $_SESSION['message'] = "Your account has been activated!";
        $mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        $_SESSION['logged_in'] = 1;
        header("location: index.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: signup.php");
}
?>
