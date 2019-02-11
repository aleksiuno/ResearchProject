<?php
class Database{
  private $host;
  private $user;
  private $pass;
  private $db;
  private $mysqli;

  public function __construct() {
    $this->dbConnect();
  }

  public function dbConnect(){
    $this->host = 'localhost';
    $this->user = 'root';
    $this->pass = '';
    $this->db = 'tutorialdb';
    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
    return $this->mysqli;
  }

  public function query($sql){
    $result = $this->mysqli->query($sql);
    return $result;
  }
  public function escapeString($aString){
    $escapedString = $this->mysqli->escape_string($aString);
    return $escapedString;
  }
}
?>
