var ViewsAdminUsers = Class.extend({
    datatable: null,
    datatables_params: null,
    datatables_fields: [],
    add_user_endpoint: null,
    init: function(datatables_params, add_user_endpoint) {
        this.datatables_params = datatables_params;
        //this.add_user_endpoint = add_user_endpoint;
         
        
        jQuery(document).data("ViewsAdminUsers", this);

        jQuery(document).ready(function(){
            jQuery("#btn-create-user").click($(document).data("ViewsAdminUsers").createUserClick);

            for (i = 0; i < jQuery(document).data("ViewsAdminUsers").datatables_params.fields.length; i++) {
                var filtered_field_columns = {
                    data: jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].id,
                    name: jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].id,
                    orderable: jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].ordenable,
                    searchable: jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].searchable
                };

                if (jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].width != null) {
                    filtered_field_columns.width = jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].width;
                }

                if (jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].className != null) {
                    filtered_field_columns.className = jQuery(document).data("ViewsAdminUsers").datatables_params.fields[i].className;
                }

                jQuery(document).data("ViewsAdminUsers").datatables_fields.push(filtered_field_columns);
            }

            jQuery(document).data("ViewsAdminUsers").datatable = $("#datatable-responsive").DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                fixedHeader: {
                    header: true
                },
                ajax:{
                    url: jQuery(document).data("ViewsAdminUsers").datatables_params.url,
                    data: function (d) {

                    }
                }
                ,
                columns: jQuery(document).data("ViewsAdminUsers").datatables_fields,
                select: {
                    'style': 'multi'
                },
                order: [
                    [0, "desc"]
                ],
                fnInitComplete: function () {
                    $('#card-body-loader').hide();
                    $('#card-body').fadeIn(1000);
                }
            });
        });
    },
    createUserClick: function(event) {
        jQuery('#dynamic_modal_title').html('Create User');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-create-user').html());
        jQuery('.agentselect').css('display','none');
        jQuery('#dynamic_modal').modal('show');

        jQuery(".form_add_user").submit($(document).data("ViewsAdminUsers").addUserSubmit);
    },
    addUserSubmit: function(event) {
        jQuery.ajax({
            url: $(this).attr("action"),
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
                    viewsGlobalInstance.showSuccess(data.data.mens);
                    table = $('#datatable-responsive').DataTable().ajax.reload();
                    $('#dynamic_modal').modal('hide');
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
          $('#dynamic_modal').modal('hide');
      }
      $('input[type=submit]').attr('disabled', false);  
    } catch(error) {

    }
  },
   sendForm: function(form,callBack) {
    
      var formData = new FormData();
      //this.sendPost(form.action, formData, callBack);
      $.ajax({
          type: "POST",
          url: form.action,
          data: new FormData(form),
          dataType: "JSON",
          processData: false,
          contentType: false,
          //success: callBack(result, status)
          success: function(result, status) {
               try {
                  var obj = result;

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
          }
      });
      $('input[type=submit]').attr('disabled', true);  
      return false;
  }


});



function showDeleteForm(id){
            var deactivated_link = $('#deactivated_link').val();
            viewsAdminInstance.showDialog(deactivated_link+id,"Deactivate the user");
          }

function showActivateForm(id){
        var activated_link = $('#activated_link').val();
        viewsAdminInstance.showDialog(activated_link+id,"Activate the user");
}

});

