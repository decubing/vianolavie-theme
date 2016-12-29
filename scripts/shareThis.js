function initializeShareThis() {
	(function($) {
		$("#footer").append("<script type='text/javascript'>var switchTo5x=true;</script>")
		.append("<script type='text/javascript' src='http://ws.sharethis.com/button/buttons.js'></script>")
	  .append("<script type='text/javascript'>window.onload = function(){stLight.options({publisher: 'c4c9ae2d-d7da-4566-8c12-81322c698864-051c', doNotHash: false, doNotCopy: false, hashAddressBar: false});}</script>")
  })( jQuery );
}