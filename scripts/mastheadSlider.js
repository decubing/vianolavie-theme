//Create Function to Control a Masthead Slider
(function($) {
	$.fn.mastheadSlider = function( options ) {
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    	$('a.masthead_scroller-control_prev').css('display','none');
      $('a.masthead_scroller-control_next').css('display','none');
      this.css({'overflow-x':'scroll', '-webkit-overflow-scrolling':'touch'});
    }else{
  		var settings = $.extend({        
      	slider : '.masthead_scroller-slider',
      	singleSlide : '.slider-listed_post',
//       	 : localStorage.getItem('firstTime'), 
  	  }, options ); 
  	  
	

      // On window resize checks width and length so that the slider functions properly in different window sizes 	
      $(window).resize(function() {
        var slideCount = $(settings.singleSlide).length;
        var slideWidth = $(settings.singleSlide).width();
        var sliderWidth = $(settings.singleSlide).length * $(settings.singleSlide).width();
        $(settings.slider).css({ width: $(settings.slider).width()/2});
      });
      
      //Clones all posts to back of sliding train     
      $(".slider-listed_post").clone().appendTo(settings.slider);
	  // Pushes the slider content over by 2       
        this.css({"margin-left":-$(settings.singleSlide).width()});
		this.css('overflow','hidden');
      function moveRight() {
        $(settings.slider).animate({
          left: - $(settings.singleSlide).width(),
        }, 1000, function () {
          $('.slider-listed_post:first-child').appendTo(settings.slider);
          $(settings.slider).css('left', '');
        });
      }

      // Set position of left control based on width
      $('a.masthead_scroller-control_prev').css({
        "left":$(settings.singleSlide).width(),
        "right":"unset"
      });
      
      $('a.masthead_scroller-control_prev').click(function (e) {
        e.preventDefault();
        $(settings.slider).animate({
          left: + $(settings.singleSlide).width()
        }, 1000, function () {
          $('.slider-listed_post:last-child').prependTo(settings.slider);
          $(settings.slider).css('left', '');
        });
      });

      $('a.masthead_scroller-control_next').click(function (e) {
        e.preventDefault();
        moveRight();
      });
    }
  };
})( jQuery );
