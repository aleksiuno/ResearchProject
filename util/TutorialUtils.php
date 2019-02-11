<?php
include "RatingUtils.php";

class TutorialUtils{
  private $mysqli="";
  private $ratingUtils;

  //Constructor to initialise variables
  public function __construct() {
    $this->mysqli = new Database();;
    $this->ratingUtils = new RatingUtils();
  }
  //Loads tutorials by keywords
  public function loadTutorialsByKeywords($aKeywords){
    $keywords = $this->mysqli->escapeString($aKeywords);
    $confirmed = 1; //load only confirmed tutorials
    $adminBtns = false;
    $request = "SELECT * FROM tutorials WHERE confirmed LIKE '%".$confirmed."%' AND (softwareName LIKE '%".$keywords."%' OR creator LIKE '%".$keywords."%' OR keywords LIKE '%".$keywords."%' OR difficulty LIKE '%".$keywords."%') ORDER BY baesian DESC";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      $rownumb = 0;
      while($row = $result->fetch_assoc()) {
          $rownumb = $rownumb + 1;
          $this->printTutorial($row['id'], $row['link'], $row['softwareName'], $row['creator'], $row['difficulty'], $row['keywords'], $row['description'], $rownumb, $adminBtns);
      }
    }
  }
  //Loads tutorails that client submitted
  public function loadClientTutorials(){
    $adminBtns = false;
    $clientid = $_SESSION['id'];
    $request = "SELECT * FROM tutorials WHERE userid='$clientid'";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      $rownumb = 0;
      while($row = $result->fetch_assoc()) {
          $rownumb = $rownumb + 1;
          $confirmed = $row['confirmed'];
          $this->printTutorial($row['id'], $row['link'], $row['softwareName'], $row['creator'], $row['difficulty'], $row['keywords'], $row['description'], $rownumb, $adminBtns, $confirmed);
      }
    }
  }
  //Loads tutorails that needs admin confirmation
  public function loadPendingTutorials(){
    $adminBtns = true;
    $confirmed = 3;
    $pendingTuts = 0;//0 indicating that tutorial is pending
    $request = "SELECT * FROM tutorials WHERE confirmed='$pendingTuts'";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      $rownumb = 0;
      while($row = $result->fetch_assoc()) {
          $rownumb = $rownumb + 1;
          $this->printTutorial($row['id'], $row['link'], $row['softwareName'], $row['creator'], $row['difficulty'], $row['keywords'], $row['description'], $rownumb, $adminBtns, $confirmed);
      }
    }
  }
  //Loads all confirmed tutorlials
  public function loadConfirmedTutorials(){
    $adminBtns = true;
    $confirmed = 3;
    $confirmedTuts = 1;//1 indicating that tutorial is confirmed
    $request = "SELECT * FROM tutorials WHERE confirmed='$confirmedTuts'";
    $result = $this->mysqli->query($request);
    if ($result->num_rows > 0) {//If found database entry, user already exists
      // output data of each row
      $rownumb = 0;
      while($row = $result->fetch_assoc()) {
          $rownumb = $rownumb + 1;
          $this->printTutorial($row['id'], $row['link'], $row['softwareName'], $row['creator'], $row['difficulty'], $row['keywords'], $row['description'], $rownumb, $adminBtns, $confirmed);
      }
    }
  }
  public function confirmTutorial($aLink){
    $link = urlencode($aLink);
    $request = "SELECT * FROM tutorials WHERE link='$link'";
    $result = $this->mysqli->query($request);
    $confirmedtut = 1;
    if ($result->num_rows > 0) {//If found database entry, user already exists
      $requestaccept = "UPDATE tutorials SET confirmed = $confirmedtut WHERE link = '$link'";
      $this->mysqli->query($requestaccept);//Checks if value was added to db successfully
      $this->loadPendingTutorials();
    }else{
      echo "Something went wrong!";
    }
  }
  public function rejectTutorial($aLink){
    $link = urlencode($aLink);
    $request = "SELECT * FROM tutorials WHERE link='$link'";
    $result = $this->mysqli->query($request);
    $confirmedtut = 1;
    if ($result->num_rows > 0) {//If found database entry, user already exists
      $requstdeny = "DELETE FROM tutorials WHERE link='$link'";
      $this->mysqli->query($requstdeny);
      $this->loadPendingTutorials();
    }else{
      echo "Something went wrong!";
    }
  }
  private function getRating(){
    $rating = 0;
    $request = "SELECT * FROM tutorials WHERE confirmed='$confirmedTuts'";
    return $rating;
  }
  //Prints a tutorial entry
  private function printTutorial($aTutorialId, $aLink, $aSoftwareName, $aCreator, $aDifficulty, $aKeywords, $aDescription, $anEntryNumb, $addAdminBtns = false, $isConfirmed = 3){
          //Tutorial ID variables
          $id = $aTutorialId;
          $tutid = $anEntryNumb."entry";
          $ratingid = $anEntryNumb."rating";
          $modalid = $anEntryNumb."modal";
          //Tutorial dat
          $rating = 0;//Initialising rating
          $link = $aLink;
          $softwareName = $aSoftwareName;
          $creator = $aCreator;
          $difficulty = $aDifficulty;
          $keywords = $aKeywords;
          $description = $aDescription;
          //Tutorial additional options
          $submitRatingBtn = '';
          $adminBTNS =  $addAdminBtns;
          $adminBtns = "";
          $confirmed = $isConfirmed;
          $tutcolor = "rgba(255,255,255,0)";
          $textColor = "";
          switch ($confirmed){//Change tutorial color depending of confirmed or not
            case '0'://Tutorial pending
              $tutcolor = "rgb(31,155,207)";
              $textColor = " text-light";
              break;
            case '1'://Tutorial accepted
              $tutcolor = "rgb(75,191,115)";
              $textColor = " text-light";
              break;
            default:
              break;
          }
          if($adminBTNS){//Adds confirmation buttons if logged in as admin
            $adminBtns = '
            <div class="col-auto">
                <div><button class="btn btn-primary" type="button" style="height:65px;width:65px;padding:5px;margin:3px;background-color:rgba(255,255,255,0);" id="acpt'.$tutid.'"><i class="fas fa-check" style="font-size:22px;color:rgb(75,191,115);" id="acpt'.$tutid.'""></i></button></div>
                <div><button class="btn btn-primary" type="button" style="height:65px;font-size:16px;width:65px;padding:5px;margin:3px;background-color:rgba(255,255,255,0);" id="deny'.$tutid.'"><i class="fas fa-times" style="font-size:26px;color:rgb(217,83,79);"id="deny'.$tutid.'""></i></button></div>
            </div>
            ';
          }
          if(isset($_SESSION['id']) && $_SESSION['logged_in'] == true){// if logged in then reveal the button
            $submitRatingBtn = '
                      <div style="margin:auto;"><button class="btn btn-primary" disabled="disabled" type="button" id="submitrating" style="height:28px;padding:0px 30px;margin:auto;width:100%;">Submit</button></div>';
          }
          $youtubeVid = preg_replace(//Converting regular youtube link to embedable
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe class=\"d-block\" width=\"100%\" height=\"auto\" allowfullscreen=\"\" frameborder=\"0\" src=\"//www.youtube.com/embed/$2\" style=\"width:100%;height:auto;margin:auto;\"></iframe>",
            urldecode($link));

          $rating = $this->ratingUtils->getAverageRating($id);

          //The code below inserts new tutorial entrie from db to webpage
          echo'<div class="justify-content-center align-items-start align-self-stretch" id="tutorialentry" style="padding:15px;height:auto;">
                <div class="row justify-content-center align-items-center" style="background-color:'.$tutcolor.';">
                  '.$adminBtns.'
                  <div class="col-auto">
                      <button class="btn btn-primary d-block" type="button" id="modalimage" data-toggle="modal" data-target="#'.$modalid.'" style="margin:auto;background-color:rgba(255,255,255,0)"><img class="img-thumbnail" src="assets/img/Logo.svg" style="width:130px;background-color:rgba(255,255,255,0);border:0px"></button>
                  </div>
                  <div class="col">
                          <div class="d-block" style="margin:auto;width:100%;">
                              <p class="text-center'.$textColor.'" style="height:4px;text-transform:capitalize;">'.$softwareName.'</p>
                              <p class="text-center'.$textColor.'" style="height:4px;text-transform:capitalize;">'.$creator.'</p>
                              <p class="text-center'.$textColor.'" style="height:4px;text-transform:capitalize;">'.$difficulty.'</p>
                              <a href="'.urldecode($link).'" target="_blank" id="'.$tutid.'">
                                  <p class="text-nowrap text-center text-primary" style="height:4px;" target="_blank">Link to the webpage.</p>
                              </a>
                          </div>
                  </div>
                  <div class="col" id="'.$ratingid.'">
                  <input type="hidden" id="tutorialId" name="tutorialId" value="'.$id.'">
                  <input type="hidden" id="rutorialRating" name="rutorialRating" value="'.$rating.'">
                      <div class="d-flex justify-content-center">
                          <p id="avrating" style="color:rgb(0,0,0);font-size:18px;margin:0px;"><strong>'.$rating.'</strong></p>
                          <p class="text-center" style="font-size:18px;margin:0px;">/5</p>
                      </div>
                      <p class="text-center d-block" style="font-size:27px;height:100%;width:160px;background-position:center;margin:auto;padding:0px 0px;"><i class="fa fa-star" id="star1"></i><i class="fa fa-star" id="star2"></i><i class="fa fa-star" id="star3"></i><i class="fa fa-star" id="star4"></i><i class="fa fa-star" id="star5"></i></p>
                      '.$submitRatingBtn.'
                  </div>
              </div>
              <div id="horizontalline"><div><hr></div></div>
              <div class="modal fade" role="dialog" tabindex="-1" id="'.$modalid.'">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="text-center modal-title" style="width:100%;color:rgb(72,72,72);font-family:Montserrat, sans-serif;font-size:23px;">TUTORIAL INFO</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                          <div class="modal-body" style="font-family:Montserrat, sans-serif;">
                              '.$youtubeVid.'
                              <p class="text-center" style="height:4px;text-transform:capitalize;">'.$softwareName.'</p>
                              <p class="text-center" style="height:4px;text-transform:capitalize;">'.$creator.'</p>
                              <p class="text-center" style="height:4px;text-transform:capitalize;">'.$keywords.'</p>
                              <p class="text-center" style="height:4px;text-transform:capitalize;">'.$difficulty.'</p>
                              <p class="text-center" style="height:4px;text-transform:capitalize;">'.$description.'</p>
                              <a href="'.urldecode($link).'" target="_blank">
                                  <p class="text-center text-primary" style="height:4px;width:auto;" target="_blank">Link to the webpage.</p>
                              </a>
                          </div>
                          <div class="modal-footer"></div>
                          </div>
                      </div>
                  </div>
              </div>';
  }
}
?>
