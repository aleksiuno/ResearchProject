<?php
require("util/RatingUtils.php");
$tutorialID = $_POST['tutorialId'];
$tutorialRating = $_POST['tutorialRating'];
$ratingUtils = new RatingUtils();
$ratingMessage = $ratingUtils->submitRating($tutorialID, $tutorialRating);
$rating = $ratingUtils->getAverageRating($tutorialID);
echo $rating;
/*
echo '        <div class="alert alert-info" style="width:100%;margin:0px 0px 20px 0px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$ratingMessage.'
              </div>';
*/
?>
