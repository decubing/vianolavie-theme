(function($) {

  //Toggle Mobile Nav
  $.fn.toggleMobileNav = function( options ) {

    //Set Settings
    var settings = $.extend({
      mobileNav: '.content-navigation'
    }, options );
    
    //On Toggle Click
    this.click(function() { 
      
      $(this).toggleClass('toggled');
          
      //Check if Mobile Nav Is Showing
      if($(settings.mobileNav).hasClass('showing')){
        $(settings.mobileNav).removeClass('showing').addClass('hiding');
      }else{
        $(settings.mobileNav).removeClass('hiding').addClass('showing');
      }

    });
  };

})(jQuery);