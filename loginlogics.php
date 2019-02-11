<?php
//Escape email to protect from sql injection
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ($result->num_rows == 0){//User wasn't found
    $_SESSION['message'] = "User with this email doesn't exist!";
}
else {//User was found
    $user = $result->fetch_assoc();
    if (password_verify($_POST['password'], $user['password'])) {
        if($user['active'] == 0){
          $_SESSION['message'] = "You have not confirmed your email!";
        }else{
          $_SESSION['id'] = $user['id'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['logged_in'] = true;
          $_SESSION['admin'] = $user['admin'];
          header("location: profile.php");
        }
    }
    else {
        $_SESSION['message'] = "You have entered the wrong password!";
    }
}
