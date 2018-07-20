var ViewsAdminAgency = Class.extend({
    datatable: null,
    datatables_params: null,
    datatables_fields: [],
    url: null,
    init: function(datatables_params,url) {
        this.datatables_params = datatables_params;
        this.url = url;

        jQuery(document).data("ViewsAdminAgency", this);

        jQuery(document).ready(function(){
            jQuery("#btn-create-user").click($(document).data("ViewsAdminAgency").createUserClick);
            $("#form-edit-agency").submit($(document).data("ViewsAdminAgency").onAgencySubmit);

            for (i = 0; i < jQuery(document).data("ViewsAdminAgency").datatables_params.fields.length; i++) {
                var filtered_field_columns = {
                    data: jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].id,
                    name: jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].id,
                    orderable: jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].ordenable,
                    searchable: jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].searchable
                };

                if (jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].width != null) {
                    filtered_field_columns.width = jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].width;
                }

                if (jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].className != null) {
                    filtered_field_columns.className = jQuery(document).data("ViewsAdminAgency").datatables_params.fields[i].className;
                }

                jQuery(document).data("ViewsAdminAgency").datatables_fields.push(filtered_field_columns);
            }

            jQuery(document).data("ViewsAdminAgency").datatable = $("#datatable-responsive").DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                fixedHeader: {
                    header: true
                },
                ajax:{
                    url: jQuery(document).data("ViewsAdminAgency").datatables_params.url,
                    data: function (d) {

                    }
                }
                ,
                columns: jQuery(document).data("ViewsAdminAgency").datatables_fields,
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
        jQuery('#dynamic_modal_body').html(jQuery('#modal-create-agency').html());
        jQuery('#dynamic_modal').modal('show');
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
  onAgencySubmit: function(event) {
    
       jQuery.ajax({
            url: jQuery(document).data("ViewsAdminAgency").url,
            type: 'POST',
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
                            $("#" + message_group).addClass("error");
                            $("#" + message_group).after( '<label class="error validation-errors" for="' + message_group + '">' + data.data[message_group][i] + '</label>');
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
    }
});