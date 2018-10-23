var ViewsAdminMyAccount = Class.extend({
    edit_endpoint: null,
    init: function(edit_endpoint) {
        this.edit_endpoint = edit_endpoint;

        jQuery(document).data("ViewsAdminMyAccount", this);

        jQuery(document).ready(function(){
            $("#form-my-account").submit($(document).data("ViewsAdminMyAccount").onMyAccountSubmit);
        });
    },
    onMyAccountSubmit: function(event) {
        jQuery.ajax({
            url: jQuery(document).data("ViewsAdminMyAccount").edit_endpoint,
            type: $(this).attr("method"),
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data, status) {
                $(".validation-errors").remove();
                $(".form-validate .error").removeClass("error");

                if (data.status == 'alert') {
                    for (var message_group in data.data) {
                        for (i = 0; i < data.data[message_group].length; i++) {
                            viewsGlobalInstance.showError(data.data[message_group][i]);
                        }
                    }

                    jQuery.scrollTo(jQuery(".validation-errors:first"), 800);
                } else if (data.status == 'error') {
                    viewsGlobalInstance.showNotification('error', data.data.message);
                } else {
                    viewsGlobalInstance.showNotification('success', data.data.message);
                    setTimeout(function() {
                        window.location = data.data.redirect;
                    }, 3000)
                }
            },
            error: function (xhr, desc, err) {
                console.log(xhr);
            }
        });

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
          $('.img_place').html('');
          $('#dynamic_modal').modal('hide');
      }
      $('input[type=submit]').attr('disabled', false);  
    } catch(error) {

    }
  },
});