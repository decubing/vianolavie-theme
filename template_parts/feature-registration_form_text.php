<?php 
if(is_page('register')):
?>

<div class="feature-registration_form_text">
  
  <?php
  if($_GET != null){
    echo '<p class="lead">Your registration will be linked to the class <span id="class_name" style="font-weight:bold;
  background: yellow;  padding: 6px;">'.$_GET['class'].'</span>. If this is not your class, please contact your teacher before submitting the form.</p>';
  }else{
    echo '<p class="lead"><span id="class_name" style="font-weight:bold;
  background: yellow;  padding: 6px;">Your registration is not linked to a class</span>. If this is an error, please contact your teacher before submitting the form.</p>';      
  }
  ?>
  
</div>

<?php endif; ?>