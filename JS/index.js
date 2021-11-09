$(window).ready(function() {
  mouseHover();
  $("#imgContinue").animate({
    'opacity': '1'
  }, 8000);
})

function mouseHover() {
  $("#continueButton").hover(function() {
    $("#imgContinue").stop(false, false).animate({
      'margin-left': '20px'
    }, 375);
    $("#continueText").addClass("colorButtonContinue");
  }, function() {
    $("#imgContinue").stop(false, false).animate({
      'margin-left': '0px'
    }, 375);
    $("#continueText").removeClass("colorButtonContinue");
  })
}

function scrollMouse() {
  var delay = false;
  $(document).on('mousewheel DOMMouseScroll', function(event) {
    event.preventDefault();
    if (delay) return;

    delay = true;
    setTimeout(function() {
      delay = false
    }, 200)

    var wd = event.originalEvent.wheelDelta || -event.originalEvent.detail;

    var a = document.getElementsByTagName('a');
    if (wd < 0) {
      for (var i = 0; i < a.length; i++) {
        var t = a[i].getClientRects()[0].top;
        if (t >= 40) break;
      }
    } else {
      for (var i = a.length - 1; i >= 0; i--) {
        var t = a[i].getClientRects()[0].top;
        if (t < -20) break;
      }
    }
    if (i >= 0 && i < a.length) {
      $('html,body').animate({
        scrollTop: a[i].offsetTop
      });
    }
  });
}
