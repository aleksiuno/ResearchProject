<?php
require "util/TutorialUtils.php";//Importing tutorial printing utils
  $tutorialUtils = new TutorialUtils;//Creating tutorial utils object
  $action = $_POST['action'];//getting variables from JS
  //Loading object method depending on action needed
  if($action == "loadTutorialsByKeywords"){//If search tutorials by keywords
    $keywords = $_POST['keywords'];
    $tutorialUtils->loadTutorialsByKeywords($keywords);
  }
  else if($action == "loadClientTutorials"){//If search tutorials by keywords
    $tutorialUtils->loadClientTutorials();
  }
  else if($action == "loadPendingTutorials"){//If search tutorials by keywords
    $tutorialUtils->loadPendingTutorials();
  }
  else if($action == "loadConfirmedTutorials"){//If search tutorials by keywords
    $tutorialUtils->loadConfirmedTutorials();
  }
  else if($action == "acpt"){//If search tutorials by keywords
    $link = $_POST['link'];
    $tutorialUtils->confirmTutorial($link);
  }
  else if($action == "deny"){//If search tutorials by keywords
    $link = $_POST['link'];
    $tutorialUtils->rejectTutorial($link);
  }
?>
