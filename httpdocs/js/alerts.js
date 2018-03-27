

var globalAlertOptions = {

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

function showAlert(text){
	showNotification('alert',text);
}

function showError(text){
	showNotification('error',text);
}

function showWarning(text){
	showNotification('warning',text);
}

function showInfo(text){
	showNotification('info',text);
}


function showNotification(type, text, options = {}){
	new Noty({
	  type: type, // alert, success, error, warning, info
	  layout: globalAlertOptions.layout, // top, topLeft, topCenter, topRight, center, centerLeft, centerRight, bottom, bottomLeft, bottomCenter, bottomRight
	  theme: globalAlertOptions.theme, // relax, mint, metroui
	  text: text,
	  timeout: (options.timeout) ? options.timeout : globalAlertOptions.timeout, //	false, 1000, 3000, 3500, etc.
	  progressBar: (options.progressBar) ? options.progressBar : globalAlertOptions.progressBar,
	  closeWith: (options.closeWith) ? options.closeWith :  globalAlertOptions.closeWith, // click, button  - string or array
	  animation: (options.animation) ? options.animation : globalAlertOptions.animation, // If string, assumed to be CSS class name. If null, no animation at all. If function, runs the function. (v3.0.1+)
	  id: (options.id) ? options.id : globalAlertOptions.id,
	  force: (options.force) ? options.force : globalAlertOptions.force,
	  killer: (options.killer) ? options.killer : globalAlertOptions.killer,
	  queue: (options.queue) ? options.queue : globalAlertOptions.queue,
	  container: (options.container) ? options.container : globalAlertOptions.container,
	  buttons: (options.buttons) ? options.buttons : globalAlertOptions.buttons,
	  sounds: (options.sounds) ? options.sounds : globalAlertOptions.sounds,
	  titleCount: (options.titleCount) ? options.titleCount : globalAlertOptions.titleCount,
	  modal: (options.modal) ? options.modal : globalAlertOptions.modal
	}).show();
}


/*window.onerror = function(msg, url, linenumber) {
    showError('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    console.log('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    $('input[type=submit]').attr('disabled', false);
    return true;
}*/

/*var alert_duration = 5000,
alert_interval = 200,
alert_xhrPending = false,
alert_intervalTimer;

alert_intervalTimer = setInterval(function() {
    if (alert_xhrPending) return;

    $.ajax({
    	url: global_alert_url, 
    	success: function(data){
    		console.log(data);
    	},
    }).done(function() {
        alert_xhrPending = false;
    });


    alert_xhrPending = true;
}, alert_interval);

setTimeout(function() {
    clearInterval(alert_intervalTimer);
}, alert_duration);*/