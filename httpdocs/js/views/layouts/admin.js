var ViewsLayoutsAdmin = Class.extend({
    init: function(){
        jQuery(document).ready(function(){
        	
        });
    },
	showDialog: function(url,title) {

	    $('#dynamic_modal_title').html(title);
	    viewsGlobalInstance.sendGet(url, this.responseDialog);
	    return false;
	},
	responseDialog: function(result) {
	    $('#dynamic_modal_body').html(result);
		$('#dynamic_modal').modal('show');	
		$('#example-datepicker-9')
	        .datepicker({
	            container:'#example-datepicker-container-9',
	            startDate: '+0d',
	            format: 'yyyy-mm-dd',
	        });
	}
});