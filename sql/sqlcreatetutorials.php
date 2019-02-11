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
//Creating database
if ( !$mysqli->query('CREATE DATABASE tutorialdb') ) {
    printf("Errormessage: %s\n", $mysqli->error);
}
//create users table with all the fields
$mysqli->query('
CREATE TABLE `tutorialdb`.`tutorials`(
`id` INT NOT NULL AUTO_INCREMENT,
`softwareName` VARCHAR(32) NOT NULL,
`creator` VARCHAR(32),
`keywords` VARCHAR(100) NOT NULL,
`link` VARCHAR(100) NOT NULL,
`difficulty` VARCHAR(16) NOT NULL,
`paid` BOOL NOT NULL DEFAULT 0,
`description` VARCHAR(140),
`confirmed` BOOL NOT NULL DEFAULT 0,
`userid` INT NOT NULL,
`baesian` DECIMAL(6,4) NOT NULL DEFAULT 0,
PRIMARY KEY (`id`));') or die($mysqli->error);
?>
