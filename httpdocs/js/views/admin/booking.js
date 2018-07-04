var ViewsAdminBooking = Class.extend({
    cancel_booking_endpoint: null,
    init: function(cancel_booking_endpoint) {
        this.cancel_booking_endpoint = cancel_booking_endpoint;

        jQuery(document).data("ViewsAdminBooking", this);

        jQuery(document).ready(function(){
            jQuery("#btn-cancel-booking").click($(document).data("ViewsAdminBooking").cancelBookingClick);
        });
    },
    cancelBookingClick: function(event) {
        jQuery('#dynamic_modal_title').html('Cancel Booking');
        jQuery('#dynamic_modal_body').html(jQuery('#modal-request-cancel').html());
        jQuery('#dynamic_modal').modal('show');

        jQuery(".btn-cancel-request-yes").click($(document).data("ViewsAdminBooking").cancelBookingRequest);
    },
    cancelBookingRequest: function(event) {
        jQuery.getJSON(jQuery(document).data("ViewsAdminBooking").cancel_booking_endpoint, function(data) {
            jQuery('#dynamic_modal').modal('hide');

            if (data.status == 'success') {
                viewsGlobalInstance.showSuccess('Your request to cancel this booking was successfully sent.');
            } else {
                viewsGlobalInstance.showError('There was a problem submitting your request. Please try again.');
            }
        });
    }
});