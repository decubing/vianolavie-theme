<?php
//Notice for users to report any errors with NolaVie Archive Posts

if(has_tag('nolavie-archive')):
?>

<div class="loop_content-nolavie_notice">
  Does content look wrong? <a class="nolavie_notice-report_link" href="<?php echo get_permalink(8309).'?page+url='.get_permalink(); ?>">Click here</a> to report any errors.
</div>

<?php
endif;
?>