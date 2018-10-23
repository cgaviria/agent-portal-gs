var ViewsAdminBookings = Class.extend({
    cancel_booking_endpoint: null,
    order_date_start: null,
    order_date_end: null,
    tour_date_start: null,
    tour_date_end: null,
    datatable: null,
    client_id :null,
    group_id :null,
    init: function() {
        // this.cancel_booking_endpoint = cancel_booking_endpoint;
        
        jQuery(document).data("ViewsAdminBookings", this);
        var client_id = jQuery('#client_id').val();
        var group_id = jQuery('#group_id').val();
        jQuery(document).data("ViewsAdminBookings").client_id = client_id;
        jQuery(document).data("ViewsAdminBookings").group_id = group_id;
        //jQuery("#example-datepicker-10").datepicker();
        jQuery('#example-datepicker-12')
          .datepicker({
              container:'#example-datepicker-container-12',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
                    autoclose: true
          });
           jQuery('#example-datepicker-10')
          .datepicker({
              container:'#example-datepicker-container-10',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
                    autoclose: true
          });
        jQuery('#example-datepicker-11')
          .datepicker({
              container:'#example-datepicker-container-11',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
                    autoclose: true
          });
        jQuery(document).ready(function(){
            //jQuery("#btn-order-date-range, #btn-order-date-range-main").click($(document).data("ViewsAdminBookings").orderDateFilterClick);
            //jQuery("#btn-order-date-range-remove-filter").click(jQuery(document).data("ViewsAdminBookings").removeOrderDateFilter);
             $('#btn-order-date-range, #btn-order-date-range-main').click(function(){
                $('#dynamic_modal_title').html('Order Date');
                var edit = $('#booking_filter').val();
                $(document).data("ViewsAdminBookings").sendGet(edit, $(document).data("ViewsAdminBookings").responseDialog);
                return false;
            });
              $("#btn-tour-date-range, #btn-tour-date-range-main").click(function(){
                $('#dynamic_modal_title').html('Tour Date');
                var edit = $('#tour_filter').val();
                $(document).data("ViewsAdminBookings").sendGet(edit, $(document).data("ViewsAdminBookings").responseDialog);
                return false;
            });
            //jQuery("#btn-tour-date-range, #btn-tour-date-range-main").click($(document).data("ViewsAdminBookings").tourDateFilterClick);
            jQuery("#btn-tour-date-range-remove-filter").click(jQuery(document).data("ViewsAdminBookings").removeTourDateFilter);

            jQuery("#btn-all-remove-filter").click(function(){
                jQuery(document).data("ViewsAdminBookings").removeOrderDateFilter();
                jQuery(document).data("ViewsAdminBookings").removeTourDateFilter();
                jQuery('#btn-all-remove-filter').css({"display": "none"});
                });

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
  responseDialog: function(result) {
         
         $('#dynamic_modal_body').html(result);
         $('#dynamic_modal').modal('show');  
         $('#example-datepicker-11')
          .datepicker({
              container:'#example-datepicker-container-11',
              format: 'yyyy/mm/dd',
              autoclose: true
          });
          $('#example-datepicker-10')
          .datepicker({
              container:'#example-datepicker-container-10',
              format: 'yyyy/mm/dd',
              autoclose: true
          });
          $('#example-datepicker-13')
          .datepicker({
              container:'#example-datepicker-container-13',
              format: 'yyyy/mm/dd',
              autoclose: true
          });
          $('#example-datepicker-14')
          .datepicker({
              container:'#example-datepicker-container-14',
              format: 'yyyy/mm/dd',
              autoclose: true
          });
             jQuery(".input-tour-date-start").each(function() {
            if (jQuery(document).data("ViewsAdminBookings").tour_date_start != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminBookings").tour_date_start);
            }
        });

        jQuery(".input-tour-date-end").each(function() {
            if (jQuery(document).data("ViewsAdminBookings").tour_date_end != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminBookings").tour_date_end);
            }
        });
          jQuery(".btn-cancel-request-yes").click(jQuery(document).data("ViewsAdminBookings").applyOrderDateFilter);
          jQuery(".btn-cancel-request-yes-tour").click(jQuery(document).data("ViewsAdminBookings").applyTourDateFilter);
  },
    orderDateFilterClick: function(event) {
        alert('ok');
        jQuery('#dynamic_modal_title').html('Order Date Filter');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-order-date-filter').html());
        jQuery('#dynamic_modal').modal('show');

        var a =$('#dynamic_modal');
        alert("A==>"+a);
       // jQuery('#input-order-date-start').datepicker();
      
        /*$('#example-datepicker-10')
          .datepicker({
              container:'#example-datepicker-container-10',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
                    autoclose: true
          });*/
        /*$('#example-datepicker-11')
          .datepicker({
              container:'#example-datepicker-container-11',
              startDate: '+0d',
              format: 'yyyy-mm-dd',
                    autoclose: true
          });
       
        jQuery(".btn-cancel-request-yes").click(jQuery(document).data("ViewsAdminBookings").applyOrderDateFilter);*/
    },
    applyOrderDateFilter: function(event) {
        jQuery(document).data("ViewsAdminBookings").order_date_start = null;

        jQuery(".input-order-date-start").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminBookings").order_date_start = jQuery(this).val();
                jQuery("#span-order-dates-filtering").html(' From ' + jQuery(document).data("ViewsAdminBookings").order_date_start);
            }
        });

        jQuery(document).data("ViewsAdminBookings").order_date_end = null;

        jQuery(".input-order-date-end").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminBookings").order_date_end = jQuery(this).val();
                jQuery("#span-order-dates-filtering").html(jQuery("#span-order-dates-filtering").html() + ' To ' + jQuery(document).data("ViewsAdminBookings").order_date_end);
            }
        });

        jQuery('#dynamic_modal').modal('hide');
        jQuery('#btn-all-remove-filter').css({"display": "inline-block", "padding": "6px 16px"});
        jQuery(document).data("ViewsAdminBookings").datatable.ajax.reload();
    },
    removeOrderDateFilter: function(event) {
        jQuery(document).data("ViewsAdminBookings").order_date_start = null;
        jQuery(document).data("ViewsAdminBookings").order_date_end = null;

        jQuery("#span-order-dates-filtering").html(' All');

        jQuery(document).data("ViewsAdminBookings").datatable.ajax.reload();
    },
    removeTourDateFilter: function(event) {
        jQuery(document).data("ViewsAdminBookings").tour_date_start = null;
        jQuery(document).data("ViewsAdminBookings").tour_date_end = null;

        jQuery("#span-tour-dates-filtering").html(' All');

        jQuery(document).data("ViewsAdminBookings").datatable.ajax.reload();
    },
    tourDateFilterClick: function(event) {
        jQuery('#dynamic_modal_title').html('Tour Date Filter');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-tour-date-filter').html());
        jQuery('#dynamic_modal').modal('show');

        jQuery(".input-tour-date-start").each(function() {
            if (jQuery(document).data("ViewsAdminBookings").tour_date_start != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminBookings").tour_date_start);
            }
        });

        jQuery(".input-tour-date-end").each(function() {
            if (jQuery(document).data("ViewsAdminBookings").tour_date_end != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminBookings").tour_date_end);
            }
        });

        jQuery(".btn-cancel-request-yes-tour").click(jQuery(document).data("ViewsAdminBookings").applyTourDateFilter);
    },
    applyTourDateFilter: function(event) {
        jQuery(document).data("ViewsAdminBookings").tour_date_start = null;

        jQuery(".input-tour-date-start").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminBookings").tour_date_start = jQuery(this).val();
                jQuery("#span-tour-dates-filtering").html(' From ' + jQuery(document).data("ViewsAdminBookings").tour_date_start);
            }
        });

        jQuery(document).data("ViewsAdminBookings").tour_date_end = null;

        jQuery(".input-tour-date-end").each(function() {
            if (jQuery(this).val() != "") {
                jQuery(document).data("ViewsAdminBookings").tour_date_end = jQuery(this).val();
                jQuery("#span-tour-dates-filtering").html(jQuery("#span-tour-dates-filtering").html() + ' To ' + jQuery(document).data("ViewsAdminBookings").tour_date_end);
            }
        });

        jQuery('#dynamic_modal').modal('hide');
        jQuery('#btn-all-remove-filter').css({"display": "inline-block", "padding": "6px 16px"});
        jQuery(document).data("ViewsAdminBookings").datatable.ajax.reload();
    }
});
