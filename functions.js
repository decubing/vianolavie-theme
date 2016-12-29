jQuery(document).ready(function($) {

   $('.load_posts-button').click(function (e) {
      console.log("Yes");
      $(".loop_content-load_posts").hide();
      e.preventDefault();
      $(".front_page-loop_content").animate({
        "max-height": "10000"
      }, 500, function () {
      });
    });
  
  //jSticky Items
  if($('iframe').hasClass("media_masthead-media_content")){
    $("#header").sticky({
      stopper:".loop_content-single_post",
    });
  }else{
    $("#header").sticky({
    	stopper:".feature-popular_tags, .loop_content-single_post",
    });    
  }
  $(".sidebar-suggested_content").stick_in_parent();
  $(".feature-page_sharer").stick_in_parent();
  
  //ticky Width Hack
  var sidebarWidth = $("#sidebar").width();
  $(".sidebar-suggested_content").width(sidebarWidth);
  $( window ).resize(function() {
    var sidebarWidth = $("#sidebar").width();
    $(".sidebar-suggested_content").width(sidebarWidth);
  });
  var sharerWidth = $(".archive-page_sharer, .front_page-page_sharer").width();
  $(".feature-page_sharer").width(sharerWidth);
  $( window ).resize(function() {
    var sharerWidth = $(".archive-page_sharer, .front_page-page_sharer").width();
    $(".feature-page_sharer").width(sharerWidth);
  });

    
  //Initialize FancyBox
  $(".page_sharer-share_button").fancybox();

  //Initialize mobilenav
  mobileNav();

  //Initialize Masthead Slider
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    $('a.masthead_posts-control_prev').css('display','none');
    $('a.masthead_posts-control_next').css('display','none');
    $('.feature-masthead_posts').css({'overflow-x':'scroll', '-webkit-overflow-scrolling':'touch'})
  } else {
      mastheadSlider();
  } 

  //Initialize AutoResize
  autosize($('textarea'));
  
  //Initialize PageSharer
  pageSharer();

  //Initialize Search Expand  
  expandSearch();
  
  //Initialize ShareThis Options
  initializeShareThis();

});
