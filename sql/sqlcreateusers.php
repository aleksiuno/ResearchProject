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
CREATE TABLE `tutorialdb`.`users`(
`id` INT NOT NULL AUTO_INCREMENT,
`email` VARCHAR(100) NOT NULL,
`password` VARCHAR(100) NOT NULL,
`hash` VARCHAR(32) NOT NULL,
`admin` BOOL NOT NULL DEFAULT 0,
`active` BOOL NOT NULL DEFAULT 0,
PRIMARY KEY (`id`));') or die($mysqli->error);
?>
