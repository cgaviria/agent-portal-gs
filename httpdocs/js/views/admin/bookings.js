var ViewsAdminBookings = Class.extend({
    cancel_booking_endpoint: null,
    order_date_start: null,
    order_date_end: null,
    tour_date_start: null,
    tour_date_end: null,
    datatable: null,
    init: function() {
        // this.cancel_booking_endpoint = cancel_booking_endpoint;

        jQuery(document).data("ViewsAdminBookings", this);

        jQuery(document).ready(function(){
            jQuery("#btn-order-date-range, #btn-order-date-range-main").click($(document).data("ViewsAdminBookings").orderDateFilterClick);
            jQuery("#btn-order-date-range-remove-filter").click(jQuery(document).data("ViewsAdminBookings").removeOrderDateFilter);

            jQuery("#btn-tour-date-range, #btn-tour-date-range-main").click($(document).data("ViewsAdminBookings").tourDateFilterClick);
            jQuery("#btn-tour-date-range-remove-filter").click(jQuery(document).data("ViewsAdminBookings").removeTourDateFilter);
        });
    },
    orderDateFilterClick: function(event) {
        jQuery('#dynamic_modal_title').html('Order Date Filter');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-order-date-filter').html());
        jQuery('#dynamic_modal').modal('show');

        jQuery(".input-order-date-start").each(function() {
            if (jQuery(document).data("ViewsAdminBookings").order_date_start != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminBookings").order_date_start);
            }
        });

        jQuery(".input-order-date-end").each(function() {
            if (jQuery(document).data("ViewsAdminBookings").order_date_end != null) {
                jQuery(this).val(jQuery(document).data("ViewsAdminBookings").order_date_end);
            }
        });

        jQuery(".btn-cancel-request-yes").click(jQuery(document).data("ViewsAdminBookings").applyOrderDateFilter);
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

        jQuery(document).data("ViewsAdminBookings").datatable.ajax.reload();
    }
});