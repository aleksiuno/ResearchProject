$(document).ready(function(){
  //Rating system logics
  var tutorialRating = 0;
  var tutorialClicked = "";
  var tutorialId = "";

  function paintStars(aTutorialClicked, tutorialRating){
    var parentid = aTutorialClicked;
    if(tutorialRating <=0){
      $("#"+parentid).find("#star1").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star2").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star3").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star4").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star5").css("color", "rgb(145,154,161)");
    }
    else if(tutorialRating > 0 && tutorialRating <= 1.5){
      $("#"+parentid).find("#star1").css("color", "black");
      $("#"+parentid).find("#star2").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star3").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star4").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star5").css("color", "rgb(145,154,161)");
    }
    else if(tutorialRating > 1.5 && tutorialRating <= 2.5){
      $("#"+parentid).find("#star1").css("color", "black");
      $("#"+parentid).find("#star2").css("color", "black");
      $("#"+parentid).find("#star3").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star4").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star5").css("color", "rgb(145,154,161)");
    }
    else if(tutorialRating > 2.5 && tutorialRating <= 3.5){
      $("#"+parentid).find("#star1").css("color", "black");
      $("#"+parentid).find("#star2").css("color", "black");
      $("#"+parentid).find("#star3").css("color", "black");
      $("#"+parentid).find("#star4").css("color", "rgb(145,154,161)");
      $("#"+parentid).find("#star5").css("color", "rgb(145,154,161)");
    }
    else if(tutorialRating > 3.5 && tutorialRating <= 4.5){
      $("#"+parentid).find("#star1").css("color", "black");
      $("#"+parentid).find("#star2").css("color", "black");
      $("#"+parentid).find("#star3").css("color", "black");
      $("#"+parentid).find("#star4").css("color", "black");
      $("#"+parentid).find("#star5").css("color", "rgb(145,154,161)");
    }
    else if(tutorialRating > 4.5){
      $("#"+parentid).find("#star1").css("color", "black");
      $("#"+parentid).find("#star2").css("color", "black");
      $("#"+parentid).find("#star3").css("color", "black");
      $("#"+parentid).find("#star4").css("color", "black");
      $("#"+parentid).find("#star5").css("color", "black");
    }
  }

  $(document).on("click", ".fa-star", function(event){//After star click enables submit button
    if(tutorialClicked != ""){
      paintStars(tutorialClicked, 0);
      $("#"+tutorialClicked).find("#submitrating").attr('disabled', 'disabled');
      tutorialClicked = "";
      tutorialRating = 0;
      tutorialId = "";
    }else{

    }
    var starClicked = event.target.id;
    var tutClicked = $(this).parent().parent().attr('id');
    var tutId = $("#"+tutClicked).find("#tutorialId").attr("value");
    $("#"+tutClicked).find("#submitrating").removeAttr('disabled');
    var tutRating = starClicked.slice(4);
    tutorialRating = tutRating;
    tutorialClicked = tutClicked;
    tutorialId = tutId;
    paintStars(tutorialClicked, tutorialRating);
  });
  $(document).on("click", "#submitrating", function(event){
    if(tutorialRating != 0 && tutorialClicked != "" && tutorialId != ""){
      paintStars(tutorialClicked, 0);
      $("#"+tutorialClicked).find("#avrating").load("submitrating.php",
      {
        "tutorialRating": tutorialRating,
        "tutorialId": tutorialId
      });
      $("#"+tutorialClicked).find("#submitrating").attr('disabled', 'disabled');
      tutorialClicked = "";
      tutorialRating = 0;
      tutorialId = "";
    }
  });
});
