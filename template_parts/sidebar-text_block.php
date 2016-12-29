<?php if(get_field('add_text_block')):?>

<div class="sidebar-text_block">
  <h4><?php the_field('text_block_title');?></h4>
  
  <?php the_field('text_block_content'); ?>
  
  <?php if(get_field('add_contributor_login_link')):?>
  <a class="text_block-contributor_login" href="<?php echo wp_login_url(); ?> ">
    <span class="contributor_login-icon">
      <i class="fa fa-user" aria-hidden="true"></i>
    </span>
    Contributor Login
  </a>
  <?php endif;?>
  
</div>

<?php endif;?>

