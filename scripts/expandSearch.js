function expandSearch() {
  (function($) {
    
    // Declare variables
    var siteSearch          = $('#site_search-form'),
        searchButton        = $('#site_search-form button'),
        navigationMain      = $('.navigation-main');
                
    //Create Search Button Hide/Show Effects
    siteSearch.click(function (e) {
      var searchState = 'active';
      $(this).addClass('active');
      navigationMain.addClass('faded');
    });
    

    $(document).click(function (e) {
      if ( $(e.target).closest(siteSearch).length === 0 ) {
        siteSearch.removeClass('active');
        var searchState = 'notActive';
        navigationMain.removeClass('faded');
      }
    });
    
    //Trigger search query when ready
    searchButton.click(function (e) {
      if(!siteSearch.hasClass('active'))
        e.preventDefault();
    });    
    
  })( jQuery );
};
