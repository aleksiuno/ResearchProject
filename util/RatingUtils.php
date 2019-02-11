<?php
include "Database.php";
session_start();

class RatingUtils{
  private $mysqli="";

  //Constructor to initialise variables
  public function __construct() {
    $this->mysqli = new Database();;
  }

  public function submitRating($aTutId, $aRating){
    $tutId = $this->mysqli->escapeString($aTutId);
    $rating = $this->mysqli->escapeString($aRating);
    $returnMessage = "";

    if(isset($_SESSION['id']) && is_numeric($rating) && $rating > 0 && $rating <= 5){
      $userId = $_SESSION['id'];
      $ratingExists = $this->mysqli->query("SELECT * FROM ratings WHERE tutorialid='$tutId' AND userid='$userId'");
      if ($ratingExists->num_rows == 0){//Rating wasn't found create rating
        $requestSubmit = "INSERT INTO ratings (tutorialid, userid, rating)"
        ."VALUES ('$tutId','$userId','$rating')";
        $this->mysqli->query($requestSubmit);
        //Update tutorial Baesian value
        $baesian = $this->bayesianEstimate($tutId, 1);
        $baesianUpdate = "UPDATE tutorials SET baesian='$baesian' WHERE id='$tutId'";
        $this->mysqli->query($baesianUpdate);
        //Confirmation message
        $returnMessage = "You've successfully rated the tutorial!";
      }else{//Rating was found, update rating
        $requestUpdate = "UPDATE ratings SET rating='$rating' WHERE tutorialid='$tutId' AND userid='$userId'";
        $this->mysqli->query($requestUpdate);
        //Update tutorial Baesian value
        $baesian = $this->bayesianEstimate($tutId, 1);
        $baesianUpdate = "UPDATE tutorials SET baesian='$baesian' WHERE id='$tutId'";
        $this->mysqli->query($baesianUpdate);
        //Confirmation message
        $returnMessage = "You've successfully updated the tutorial rating!";
      }

    }else{
      $returnMessage = "The submited rating is not an integer!";
    }
    return $returnMessage;
  }
  public function getAverageRating($aTutorialId){
    //local variables
    $tutorialId = $aTutorialId;
    $rating = 0;
    $ratingEntries = 0;
    $ratingsSum = 0;
    $request = "SELECT * FROM ratings WHERE tutorialid='$tutorialId'";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $ratingEntries = $ratingEntries + 1;
          $ratingsSum = $ratingsSum + $row['rating'];
      }
      $rating = $ratingsSum/$ratingEntries;
    }
    return $rating;
  }
  public function getAverageRatingTogether(){
    //local variables
    $rating = 0;
    $ratingEntries = 0;
    $ratingsSum = 0;
    $request = "SELECT * FROM ratings";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $ratingEntries = $ratingEntries + 1;
          $ratingsSum = $ratingsSum + $row['rating'];
      }
      $rating = $ratingsSum/$ratingEntries;
    }
    return $rating;
  }
  public function getNumberOfVotes($aTutorialId){
    //local variables
    $tutorialId = $aTutorialId;
    $ratingEntries = 0;
    $request = "SELECT * FROM ratings WHERE tutorialid='$tutorialId'";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $ratingEntries = $ratingEntries + 1;
      }
    }
    return $ratingEntries;
  }
  /* The formula of Baesian Estimate is: (WR) = (v ÷ (v+m)) × R + (m ÷ (v+m)) × C
  * R = average for the movie (mean) = (Rating)
  * v = number of votes for the movie = (votes)
  * m = minimum votes required to be listed in the Top 250 (currently 1300)
  * C = the mean vote across the whole report (currently 6.8)
  */
  public function bayesianEstimate($aTutorialId, $aMinVotesRequired){
    $WR;
    $tutorialId = $aTutorialId;
    $minVotesRequired = $aMinVotesRequired;
    $requestRatings = "SELECT * FROM ratings WHERE tutorialid='$tutorialId'";
    $result = $this->mysqli->query($requestRatings);
    if ($result->num_rows > 0) {
      $R = $this->getAverageRating($tutorialId);
      $v = $this->getNumberOfVotes($tutorialId);
      $m = $aMinVotesRequired;
      $C = $this->getAverageRatingTogether();
      $WR = ($v/($v+$m)) * $R + ($m/($v+$m)) * $C;
    }else{
      $WR = 0;
    }
    return $WR;
  }
}
?>
