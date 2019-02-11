<?php
//Database login details
$host = 'localhost';
$user = 'root';
$password = '';
//Connecting mysqli
$mysqli = new mysqli($host,$user,$password);
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    die();
}
/*
//Creating database
if ( !$mysqli->query('CREATE DATABASE tutorialdb') ) {
    printf("Errormessage: %s\n", $mysqli->error);
}
*/
//create users table with all the fields
$mysqli->query('
CREATE TABLE `tutorialdb`.`ratings`(
`id` INT NOT NULL AUTO_INCREMENT,
`tutorialid` INT NOT NULL,
`userid` INT NOT NULL,
`rating` TINYINT(1) NOT NULL,
PRIMARY KEY (`id`));') or die($mysqli->error);
?>
