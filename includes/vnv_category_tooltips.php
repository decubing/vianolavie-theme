<?php
//Add Tooltips to categories
add_action('admin_footer', function() {
?>

<!--VNV Category Tooltips -->
<style>
.tooltip {
  position: relative;
  display: inline-block;
  color: rgba(0, 49, 168, .8);
  margin-left: 4px;
  font-size: 14px;
}
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 10px;
  left: -75px;
  position: absolute;
  z-index: 10000;
}
.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function ($) {
  $('#categorydiv h2 span').append("<div class='tooltip'><i class='fa fa-info-circle'></i> <span class='tooltiptext'>Add 1 sub-heading for subject; 1 for genre.</span></div>");
  $('#tagsdiv-post_tag h2 span').append("<div class='tooltip'><i class='fa fa-info-circle'></i> <span class='tooltiptext'>Add all proper nouns and related topics.</span></div>");
  $('#badgediv h2 span').append("<div class='tooltip'><i class='fa fa-info-circle'></i> <span class='tooltiptext'>i.e. ViaNola = Tulane</span></div>");
  $('#postimagediv h2 span').append("<div class='tooltip'><i class='fa fa-info-circle'></i> <span class='tooltiptext'>For home pg and archive.</span></div>");

  <?php
  //Start Category Loop
  $categories = get_categories();
  foreach ($categories as $category):
    
    //Categories with descriptions
    if(!empty($category->category_description)):
  ?>
            
    $('#category-<?php echo $category->term_id;?> > .selectit').append("<div class='tooltip'><i class='fa fa-info-circle'></i> <span class='tooltiptext'><?php echo $category->category_description ?></span></div>");
        
  <?php
    //End categories with descriptions
    endif;
    
  //End Category Loop
  endforeach;
  ?>
  
});
</script>

<?php
});
?>