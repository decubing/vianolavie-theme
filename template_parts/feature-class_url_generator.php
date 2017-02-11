<div class="feature-class_url_generator">
  <label class="class_url_generator-name">Class Name:</label>
  <input class="class_url_generator-input" type="text" name="txt" id="txt" size="30" required="required">
  <button class="class_url_generator-submit" onclick="generateClassURL()">Generate URL</button>
  <hr>
  <label class="class_url_generator-url">Custom URL:</label>
  <p class="class_url_generator-result" id="result"></p>
  
  <script>
  function generateClassURL() {
      var uri = document.getElementById("txt").value;
      var res = encodeURIComponent(uri);
      var vianola = "<?php echo esc_url( home_url( '/' ) ); ?>/register?class=";
      document.getElementById("result").innerHTML = vianola+res;
  }
  </script>
</div>