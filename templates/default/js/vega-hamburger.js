var clicked = false;
$( document ).ready(function() {
  $("#shop-menu-container").click(function(){
    setMenu();
    clicked = !clicked;
  });

  $("#body").click(function(){
    if ($(window).width() < 568){
      closeMenu();
    }
  });

  $("#foot").click(function(){
    if ($(window).width() < 568){
      closeMenu();
    }
  });

  $("#body-overlay").click(function(){
    if ($(window).width() < 568){
      closeMenu();
    }
    setDefaultSmall();
  });
});

function setMenu(){
  if(!clicked){
    $("#head3").css({"display":"block"});
    $("#body-overlay").addClass("openOverlay");
  }
  else {
    $("#head3").css({"display":"none"});
    $("#body-overlay").removeClass("openOverlay");
  }
}

function closeMenu(){
  $("#head3").css({"display":"none"});
  $("#body-overlay").removeClass("openOverlay");
  clicked = false;
}

$(window).on('resize', function(){
  if ($(window).width() >= 568){
    $("#head3").css({"display":"block"});
  }

  if ($(window).width() < 568){
    closeMenu();
  }
});
