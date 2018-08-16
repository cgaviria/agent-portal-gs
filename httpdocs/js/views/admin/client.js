var ViewsAdminClients = Class.extend({
    cancel_booking_endpoint: null,
    order_date_start: null,
    order_date_end: null,
    tour_date_start: null,
    tour_date_end: null,
    datatable: null,
    fields : null,
    getdataurl : null,
    order : null,
    edit: null,
    imports: null,
   
    init: function(fields, getdataurl, order, edit, imports) {
        this.edit = edit;
        this.imports = imports;
        // this.cancel_booking_endpoint = cancel_booking_endpoint;
        jQuery(document).ready(function(){
            $("#form-edit-client").submit($(document).data("ViewsAdminClients").onClientSubmit);
        });
        $('#create_client').click(function(){
            $('#dynamic_modal_title').html('Add client');
            $(document).data("ViewsAdminClients").sendGet(edit, $(document).data("ViewsAdminClients").responseDialog);
            return false;
        });
         $('#import_client').click(function(){
            $('#dynamic_modal_title').html('Import client');
            $(document).data("ViewsAdminClients").sendGet(imports, $(document).data("ViewsAdminClients").responseDialog);
            return false;
        });

        jQuery(document).data("ViewsAdminClients", this);
        $('#example-datepicker-9')
          .datepicker({
              container:'#sail_date',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
              autoclose: true
          });
        fieldsdata = JSON.parse(fields);
        console.log(fieldsdata);
        var table;
        var arr = [];
        var len = fieldsdata.length;
        for (var i = 0; i < len; i++) {
            arr.push({
                data: fieldsdata[i].id,
                name: fieldsdata[i].id,
                orderable: true,
                searchable: true,
                width : fieldsdata[i].width
            });
        }
        jQuery(document).data("ViewsAdminClients").datatable = jQuery("#datatable-responsive").DataTable({
          processing: true,
          serverSide: true,
          pageLength: 100,
          fixedHeader: {
              header: true
          },
          ajax:{
              url: getdataurl,
          },
          columns: arr,
          'select': {
              'style': 'multi'
          },
          'order': [[1, 'asc']],
          'bFilter': 'false',
          
          fnInitComplete: function () {
              jQuery('#card-body-loader').hide();
              jQuery('#card-body').fadeIn(1000);
          }
      });
  

  function refreshTable(){
    table = jQuery('#datatable-responsive').DataTable().ajax.reload();
  }
         
    },
    responseDialog: function(result) {
      $('#dynamic_modal_body').html(result);
    $('#dynamic_modal').modal('show');  
    $('#example-datepicker-9')
          .datepicker({
              container:'#example-datepicker-container-9',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
                    autoclose: true
          });
  },
  sendGet: function(url, callBack){
      $.ajax({
          type: "GET",
          url: url,
          //success: callBack(result, status)
          success: function(result, status) {
              callBack(result);
          }
      });
  },
    orderDateFilterClick: function(event) {
        jQuery('#dynamic_modal_title').html('Order Date Filter');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-order-date-filter').html());
        jQuery('#dynamic_modal').modal('show');

        jQuery(".input-order-date-start").each(function() {
            if (jQuery(document).data("ViewsAdminClients").order_date_start != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminClients").order_date_start);
            }
        });

        jQuery(".input-order-date-end").each(function() {
            if (jQuery(document).data("ViewsAdminClients").order_date_end != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminClients").order_date_end);
            }
        });

        jQuery(".btn-cancel-request-yes").click(jQuery(document).data("ViewsAdminClients").applyOrderDateFilter);
    },
    applyOrderDateFilter: function(event) {
        jQuery(document).data("ViewsAdminClients").order_date_start = null;

        jQuery(".input-order-date-start").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminClients").order_date_start = jQuery(this).val();
                jQuery("#span-order-dates-filtering").html(' From ' + jQuery(document).data("ViewsAdminClients").order_date_start);
            }
        });

        jQuery(document).data("ViewsAdminClients").order_date_end = null;

        jQuery(".input-order-date-end").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminClients").order_date_end = jQuery(this).val();
                jQuery("#span-order-dates-filtering").html(jQuery("#span-order-dates-filtering").html() + ' To ' + jQuery(document).data("ViewsAdminClients").order_date_end);
            }
        });

        jQuery('#dynamic_modal').modal('hide');

        jQuery(document).data("ViewsAdminClients").datatable.ajax.reload();
    },
    removeOrderDateFilter: function(event) {
        jQuery(document).data("ViewsAdminClients").order_date_start = null;
        jQuery(document).data("ViewsAdminClients").order_date_end = null;

        jQuery("#span-order-dates-filtering").html(' All');

        jQuery(document).data("ViewsAdminClients").datatable.ajax.reload();
    },
    removeTourDateFilter: function(event) {
        jQuery(document).data("ViewsAdminClients").tour_date_start = null;
        jQuery(document).data("ViewsAdminClients").tour_date_end = null;

        jQuery("#span-tour-dates-filtering").html(' All');

        jQuery(document).data("ViewsAdminClients").datatable.ajax.reload();
    },
    tourDateFilterClick: function(event) {
        jQuery('#dynamic_modal_title').html('Tour Date Filter');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-tour-date-filter').html());
        jQuery('#dynamic_modal').modal('show');

        jQuery(".input-tour-date-start").each(function() {
            if (jQuery(document).data("ViewsAdminClients").tour_date_start != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminClients").tour_date_start);
            }
        });

        jQuery(".input-tour-date-end").each(function() {
            if (jQuery(document).data("ViewsAdminClients").tour_date_end != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminClients").tour_date_end);
            }
        });

        jQuery(".btn-cancel-request-yes-tour").click(jQuery(document).data("ViewsAdminClients").applyTourDateFilter);
    },
    applyTourDateFilter: function(event) {
        jQuery(document).data("ViewsAdminClients").tour_date_start = null;

        jQuery(".input-tour-date-start").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminClients").tour_date_start = jQuery(this).val();
                jQuery("#span-tour-dates-filtering").html(' From ' + jQuery(document).data("ViewsAdminClients").tour_date_start);
            }
        });

        jQuery(document).data("ViewsAdminClients").tour_date_end = null;

        jQuery(".input-tour-date-end").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminClients").tour_date_end = jQuery(this).val();
                jQuery("#span-tour-dates-filtering").html(jQuery("#span-tour-dates-filtering").html() + ' To ' + jQuery(document).data("ViewsAdminClients").tour_date_end);
            }
        });

        jQuery('#dynamic_modal').modal('hide');

        jQuery(document).data("ViewsAdminClients").datatable.ajax.reload();
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
  },
   onClientSubmit: function(event) {

       jQuery.ajax({
            url: jQuery(document).data("ViewsAdminClients").edit,
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