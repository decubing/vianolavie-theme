//Create Function to Control a Masthead Slider
function mastheadSlider(){
  (function($) {
    var slider = '.masthead_posts-slider';
    var slideCount = $('.slider-listed_post').length;
    var slideWidth = $('.slider-listed_post').width();
    var slideHeight = $('.slider-listed_post').height();
    var sliderWidth = slideCount * slideWidth;
    $(window).resize(function() {
      slideCount = $('.slider-listed_post').length;
      slideWidth = $('.slider-listed_post').width();
      sliderWidth = slideCount * slideWidth;
    });
    $(slider).css({ width: sliderWidth,});
    $(".slider-listed_post").clone().appendTo(slider);
     $(".feature-masthead_posts").css({"margin-left":-slideWidth*2});
     
    function moveRight() {
      $(slider).animate({
        left: - slideWidth
      }, 1000, function () {
        $('.slider-listed_post:first-child').appendTo(slider);
        $(slider).css('left', '');
      });
    };
    var interval = setInterval(moveRight, 4000);
    $('a.masthead_posts-control_prev').css('left','-38px');
    $('a.masthead_posts-control_next').css('right','-38px');
    $('a.masthead_posts-control_prev').css('display','block');
    $('a.masthead_posts-control_next').css('display','block');
    $('.feature-masthead_posts').css('overflow','hidden');
    $(".feature-masthead_posts").hover(function() {
      clearInterval(interval);
    }, function() {
        interval = setInterval(moveRight, 4000);
      });
    $(".feature-masthead_posts").on({
      'mouseenter':function(){
        $('a.masthead_posts-control_prev').animate({
          left: + slideWidth*2
        }, 350)
        $('a.masthead_posts-control_next').animate({
          right: + 0
        }, 350)
      },
      'mouseleave':function(){
        $('a.masthead_posts-control_prev').animate({
          left: -38
        }, 350)
        $('a.masthead_posts-control_next').animate({
          right: -38
        }, 350)
      }
    });
    $('a.masthead_posts-control_prev').click(function (e) {
      e.preventDefault();
      $(slider).animate({
        left: + slideWidth
      }, 1000, function () {
        $('.slider-listed_post:last-child').prependTo(slider);
        $(slider).css('left', '');
      });
    });

    $('a.masthead_posts-control_next').click(function (e) {
      e.preventDefault();
      moveRight();
    });
  })( jQuery );
}