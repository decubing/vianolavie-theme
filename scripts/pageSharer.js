function pageSharer () {
	(function($) {
	  $(".feature-sharing_options").children(".fa-share").click(function(e) {
	  		var target = $( e.target );
		    navigationToggle(target.children('.sharing_content-wrapper'),'showing_page-sharer','hiding');
		    navigationToggle(target.children('.sharing_content-wrapper').children('.triangle_right'),'showing-triangle','hiding-triangle');
	  	
	  });
	  if ($("div").hasClass("listed_medium-footer")) {
	  	$(".sharing_content-wrapper").css("top","-15px !important");
	  }
	})(jQuery);
}