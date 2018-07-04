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
                            $("#" + message_group).addClass("error");
                            $("#" + message_group).after( '<label class="error validation-errors" for="' + message_group + '">' + data.data[message_group][i] + '</label>');
                        }
                    }

                    jQuery.scrollTo(jQuery(".validation-errors:first"), 800);
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