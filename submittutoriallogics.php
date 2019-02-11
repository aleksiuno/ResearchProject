<?php
//Setting variables using escape method to protect against sql injections
$userid = $mysqli->escape_string($_SESSION['id']);
$softwareName = $mysqli->escape_string($_POST['softwareName']);
$creator = $mysqli->escape_string($_POST['creator']);
$keywords = $mysqli->escape_string($_POST['keywords']);
$difficulty = $mysqli->escape_string($_POST['difficulty']);
$link = $mysqli->escape_string(urlencode($_POST['link']));
$paid = $mysqli->escape_string($_POST['paid']);
$description = $mysqli->escape_string($_POST['description']);
//Trying to find user in database
$result = $mysqli->query("SELECT * FROM tutorials WHERE link='$link'") or die($mysqli->error());
if ($result->num_rows > 0) {//If found database entry, tutorial link already exists
    $_SESSION['message'] = 'This tutorial already exists!';
}
else {//If tutorial link doesn't exist, proceed registration
    $sql = "INSERT INTO tutorials (softwareName, creator, keywords, link, difficulty, paid, description, userid)"
    ."VALUES ('$softwareName','$creator','$keywords','$link','$difficulty','$paid','$description','$userid')";
    if ( $mysqli->query($sql) ){//Add tutorial to the database
        $_SESSION['message'] =//Popup message confirming tutorial submission
         "The tutorial was successfully submited and waiting for confirmation!";
    }
    else {//If adding tutorial action fails show message
        $_SESSION['message'] = 'Submission Failed!';
    }
}
