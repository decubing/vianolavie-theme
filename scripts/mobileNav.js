  function navigationToggle (div,showing,hiding) {
    if(div.hasClass(showing)){
      div.removeClass(showing).addClass(hiding);
    }else{
      div.removeClass(hiding).addClass(showing);
    }
  }
function mobileNav () {
  (function($) {
  $(".toggle_area-toggle_button").click(function() { 
      //show its submenu
      var nav = $('.navigation-main');
      navigationToggle(nav,'showing','hiding');
      $(window).resize(function(){
        var winwidth = $(window).innerWidth();
        if(winwidth > 768){
          $(nav).removeClass('showing').removeClass('hiding');    
        }
      });
    });
  })(jQuery);
}