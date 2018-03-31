
var ViewsLayoutsLogin = Class.extend({
	init: function() {
		jQuery(document).ready(function(){
			
		});
	},
  sendFormLogin: function(form) {
    viewsGlobalInstance.sendPost(form.action, $("form#"+form.id).serialize(), this.responseFormLogin);
    return false;
  },
  responseFormLogin: function(results) {
    try {
      var obj = jQuery.parseJSON(results);
      if(obj.data.error) {
        for (var e in obj.data.errmens) {
          for (var i = 0; i < obj.data.errmens[e].length; i++ ) {
              viewsGlobalInstance.showError(obj.data.errmens[e][i]);
          }
        }  
      } else {
        window.location = obj.data.redirect;
      }
      $('input[type=submit]').attr('disabled', false);  
    } catch(error) {

    }
  }
});