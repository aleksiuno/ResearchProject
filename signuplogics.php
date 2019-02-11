<?php
//Sets session variable
$_SESSION['email'] = $_POST['email'];

//Setting variables using escape method to protect against sql injections
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
//Trying to find user in database
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());
if ($result->num_rows > 0) {//If found database entry, user already exists
    $_SESSION['message'] = 'User with this email already exists!';
}
else {//If user doesn't exist, proceed registration
    $sql = "INSERT INTO users (email, password, hash)"."VALUES ('$email','$password', '$hash')";
    if ( $mysqli->query($sql) ){//Add user to the database
        $_SESSION['active'] = 0;//0 means user has not activated email
        $_SESSION['logged_in'] = false;//User is not logged int because email is not activated
        $_SESSION['message'] =//Popup message asking to confirm email
         "The confirmation link has been sent to $email, please verify
         your email address by clicking on the active link in your email!";
         $to      = $email;
         $subject = 'Account Verification ( Tutorial Database )';
         $message_body = '
         Dear Customer,

         Thank you for signing up!
         Please click this link to activate your account:
         http://localhost/verify.php?email='.$email.'&hash='.$hash.'

         Sincerely, Tutorial Database Team';
         mail( $to, $subject, $message_body );
    }
    else {//If adding user action fails show message
        $_SESSION['message'] = 'Registration Failed!';
    }
}
