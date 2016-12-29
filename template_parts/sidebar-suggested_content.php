<?php if(get_field('add_suggested_content') || is_single()):?>

<div class="sidebar-suggested_content">
  <h4>Suggested Content</h4>
  <a class="suggested_content-listed_post" href="<?php echo get_permalink(151)?>">
    <span class="listed_post-image" style="background-image:url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(151), 'large')[0];  ?>)"></span> <!-- conditionally displayed on first image -->
    <span class="h4"><?php echo get_limited_title(151);?></span>
    <span class="listed_post-excerpt"><?php get_the_excerpt(151) ?></span>
    <?php get_badge(151);?>
  </a>
  <a class="suggested_content-listed_post" href="single.html">
<!--<span class="listed_post-image" style="background-image:url()"></span> conditionally displayed on first image -->
    <span class="h4">Lorem Ipsum <!-- impose character limit --></span>
    <span class="listed_post-excerpt">Nulla vel gravida tellus. Pellentesque diam augue, maximus ...  <!-- impose character limit --></span>
    <span class="badge badge-nolavie badge-small"></span>
  </a>
  <a class="suggested_content-listed_post" href="single.html">
  <!-- <span class="listed_post-image" style="background-image:url()"></span>  conditionally displayed on first image -->
    <span class="h4">Lorem Ipsum <!-- impose character limit --></span>
    <span class="listed_post-excerpt">Nulla vel gravida tellus. Pellentesque diam augue, maximus ...  <!-- impose character limit --></span>
    <span class="badge badge-nolavie badge-small"></span>
  </a>
</div>

<?php endif;?>

