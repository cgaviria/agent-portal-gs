var ViewsAdminUsers = Class.extend({
    datatable: null,
    datatables_params: null,
    datatables_fields: [],
    init: function(datatables_params) {
        this.datatables_params = datatables_params;

        jQuery(document).data("ViewsAdminUsers", this);

        jQuery(document).ready(function(){
            console.log(jQuery(document).data("ViewsAdminUsers").datatables_params.fields);

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

                jQuery(document).data("ViewsAdminUsers").datatables_fields.push(filtered_field_columns);
            }

            console.log(filtered_field_columns);

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
    }
});