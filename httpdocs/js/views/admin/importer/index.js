
var ViewsAdminImporter = Class.extend({
	init: function() {
		jQuery(document).ready(function(){
			
		});
	},
  sendFormAdd: function(form) {
    viewsGlobalInstance.sendPost(form.action, $("form#"+form.id).serialize(), this.responseFormAdd);
    $('input[type=submit]').attr('disabled', true);  
    return false;
  },
  responseFormAdd: function(results) {
    try {
      var obj = jQuery.parseJSON(results);
      if(obj.data.error) {
        for (var e in obj.data.errmens) {
          for (var i = 0; i < obj.data.errmens[e].length; i++ ) {
              viewsGlobalInstance.showError(obj.data.errmens[e][i]);
          }
        }  
      } else {
          viewsGlobalInstance.showInfo(obj.data.mens);
          table = $('#datatable-responsive').DataTable().ajax.reload();
          $('#dynamic_modal').modal('hide');
      }
      $('input[type=submit]').attr('disabled', false);  
    } catch(error) {

    }
  }
});