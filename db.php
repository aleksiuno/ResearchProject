<?php
//Database connection details
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'tutorialdb';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
?>
