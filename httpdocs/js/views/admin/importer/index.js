
var ViewsAdminImporter = Class.extend({
	init: function() {
		jQuery(document).ready(function(){
			
		});
	},
  sendRunForm: function(form,callBack) {
      viewsGlobalInstance.showInfo("The import proccess has begun! Please wait!");
      viewsGlobalInstance.sendPost(form.action, $("form#"+form.id).serialize(), callBack);
      $('#dynamic_modal').modal('hide');
      $('input[type=submit]').attr('disabled', true);  
      return false;
  },
  responseForm: function(results) {
    try {
      var obj = jQuery.parseJSON(results);
      if(obj.data.error) {
        for (var e in obj.data.errmens) {
          for (var i = 0; i < obj.data.errmens[e].length; i++ ) {
              viewsGlobalInstance.showError(obj.data.errmens[e][i]);
          }
        }  
      } else {
          viewsGlobalInstance.showSuccess(obj.data.mens);
          table = $('#datatable-responsive').DataTable().ajax.reload();
          $('#dynamic_modal').modal('hide');
      }
      $('input[type=submit]').attr('disabled', false);  
    } catch(error) {

    }
  },
  responseFormImporter: function(results) {
    try {
      var obj = jQuery.parseJSON(results);
      if(obj.data.error) {
        for (var e in obj.data.errmens) {
          for (var i = 0; i < obj.data.errmens[e].length; i++ ) {
              viewsGlobalInstance.showError(obj.data.errmens[e][i]);
          }
        }  
      } else {
          viewsGlobalInstance.showSuccess(obj.data.mens);
          $('#dynamic_modal').modal('hide');
      }
      $('input[type=submit]').attr('disabled', false);  
    } catch(error) {

    }
  }
});