$(function() {
  
  // SVG fallback
  if (!Modernizr.svg) {
    var imgs = document.getElementsByTagName('img');
    var dotSVG = /.*\.svg$/;
    for (var i = 0; i != imgs.length; ++i) {
      if(imgs[i].src.match(dotSVG)) {
        imgs[i].src = imgs[i].src.slice(0, -3) + "png";
      }
    }
  }
  
  // Scroll to top
  $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
      $('.scrollup').fadeIn();
    } else {
      $('.scrollup').fadeOut();
    }
  }); 
  $('.scrollup').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 700);
    return false;
  });

});