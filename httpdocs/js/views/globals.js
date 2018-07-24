
var ViewsGlobals = Class.extend({
	globalAlertOptions: null,
	init: function() {
		this.globalAlertOptions = {
			layout: 'topRight',
			theme: 'metroui',
			timeout: 5000,
			progressBar: true,
			closeWith: ['click', 'button'],
			animation: {
				open: 'noty_effects_open',
				close: 'noty_effects_close'
			},
			id: false,
			force: false,
			killer: false,
			queue: 'global',
			container: false,
			buttons: [],
			sounds: {
				sources: [],
				volume: 1,
				conditions: []
			},
			titleCount: {
				conditions: []
			},
			modal: false
		};
		jQuery(document).ready(function(){
				
		});
	},
	showAlert: function (text) {
		this.showNotification('alert',text);
	},
	showError: function(text) {
		this.showNotification('error',text);
	},
	showSuccess: function(text) {
		this.showNotification('success',text);
	},
	showWarning: function(text) {
		this.showNotification('warning',text);
	},
	showInfo: function(text) {
			this.showNotification('info',text);
	},
	showNotification: function(type, text, options = {}) {
		new Noty({
		  type: type, // alert, success, error, warning, info
		  layout: this.globalAlertOptions.layout, // top, topLeft, topCenter, topRight, center, centerLeft, centerRight, bottom, bottomLeft, bottomCenter, bottomRight
		  theme: this.globalAlertOptions.theme, // relax, mint, metroui
		  text: text,
		  timeout: (options.timeout) ? options.timeout : this.globalAlertOptions.timeout, //	false, 1000, 3000, 3500, etc.
		  progressBar: (options.progressBar) ? options.progressBar : this.globalAlertOptions.progressBar,
		  closeWith: (options.closeWith) ? options.closeWith :  this.globalAlertOptions.closeWith, // click, button  - string or array
		  animation: (options.animation) ? options.animation : this.globalAlertOptions.animation, // If string, assumed to be CSS class name. If null, no animation at all. If function, runs the function. (v3.0.1+)
		  id: (options.id) ? options.id : this.globalAlertOptions.id,
		  force: (options.force) ? options.force : this.globalAlertOptions.force,
		  killer: (options.killer) ? options.killer : this.globalAlertOptions.killer,
		  queue: (options.queue) ? options.queue : this.globalAlertOptions.queue,
		  container: (options.container) ? options.container : this.globalAlertOptions.container,
		  buttons: (options.buttons) ? options.buttons : this.globalAlertOptions.buttons,
		  sounds: (options.sounds) ? options.sounds : this.globalAlertOptions.sounds,
		  titleCount: (options.titleCount) ? options.titleCount : this.globalAlertOptions.titleCount,
		  modal: (options.modal) ? options.modal : this.globalAlertOptions.modal
		}).show();
	},
	sendForm: function(form,callBack) {
	    this.sendPost(form.action, $("form#"+form.id).serialize(), callBack);
	    $('input[type=submit]').attr('disabled', true);  
	    return false;
	},
	sendPost: function(url, data, callBack) {    
	    $.ajax({
	        type: "POST",
	        url: url,
	        data: data,
	        //success: callBack(result, status)
	        success: function(result, status) {
	            callBack(result);
	        }
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
    displayMessages: function(messages) {
        if (messages != null) {
            if (messages.success != null) {
                this.showNotification('success', messages.success);
            }
            if (messages.error != null) {
                this.showNotification('error', messages.error);
            }
		}
    }
});