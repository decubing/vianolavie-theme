
(function($) {
  $.fn.expandSearch = function() {
                
    //Create Search Button Hide/Show Effects
    this.click(function (e) {
      if(!$(this).hasClass('active') || $(window).width() > 780){
        e.preventDefault();                
      }
      $(this).addClass('active');
    });
  };  
})( jQuery );


