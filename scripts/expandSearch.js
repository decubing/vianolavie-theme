
(function($) {
  $.fn.expandSearch = function() {
    
    var searchForm = this;

    //Create Search Button Hide/Show Effects
    searchForm.find('button').click(function (e) {
      if( searchForm.hasClass('active') == false && $(window).width() > 780){
        e.preventDefault();               
      }
      searchForm.addClass('active');
    });
  };  
})( jQuery );


