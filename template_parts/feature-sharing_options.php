<!-- Gettng rid   of button and button-inline causes issues right now -->
<div class="feature-sharing_options button button-inline">
  <i class="fa fa-share sharing_options-sharing_content" aria-hidden="true">
  	<div class="sharing_content-wrapper">
  		<div class="triangle_right"></div>
		  	<a target="_blank" style=" border-right: 1px solid black" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>">
		  		<i class="fa fa-facebook"></i>
		  	</a>
			  <a target="_blank" href="https://twitter.com/home?status=<?php the_permalink();?>">
			  	<i class="fa fa-twitter"></i>
			  </a>
			  <a target="_blank" href="mailto:?&subject=On%20ViaNolaVie:%20%22<?php the_title();?>%22&body=%22<?php echo get_the_excerpt();?>%22%0A%0AFull%20article%3A%20<?php the_permalink()?>">
			  	<i class="fa fa-envelope"></i>
			  </a>
  	</div>
  </i>
</div>