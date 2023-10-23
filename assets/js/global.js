


var lastPick;
var rand;
$(document).ready(function() {
	// CONFIG SLIMSCROLL TEMPLATE
	// $('.scroller').slimScroll({
	// 	height: '100%',
	// 	size: '7px',
	// 	distance: '2px',
	// 	wheelStep: 20,
	// });
	
	// SET DARKTHEME TEMPLATE BY LOCALSTORAGE
	theme = localStorage.getItem('theme');
	if(theme == 'dark') {
		$('input#dark-theme').attr('checked', true);
	}
	$('body').toggleClass(theme);

});

// TOGGLE CHECKBOX DARKTHEME
$('input#dark-theme').on('change', function() {
	checked = $(this).is(':checked');
	if(checked == true) {
		localStorage.setItem('theme', 'dark');
	} else {
		localStorage.setItem('theme', '');
	}
	document.location.reload()
})

// SET BASE URL
var baseUrl = function() {
	pathArray = window.location.pathname.split( '/' );
	return window.location.origin+'/'+pathArray[1]+'/'+pathArray[2]+'/';
}

var randomBg = function() {
	var colors = ['bg-primary','bg-success','bg-info','bg-warning','bg-danger','bg-megna','bg-theme','bg-inverse','bg-purple'];
	var rand = colors[Math.floor(Math.random() * colors.length)];
	rand==lastPick?randomBg():rand;
	lastPick = rand;
	return rand;
}

var randomCol = function() {
	var colors = ['text-primary','text-success','text-info','text-warning','text-danger','text-megna','text-theme','text-inverse','text-purple'];
	var rand = colors[Math.floor(Math.random() * colors.length)];
	rand==lastPick?randomCol():rand;
	lastPick = rand;
	return rand;
}

// CONFIG ALERT WITH JQUERY CONFIRM
var alertMsg = function(content, type) {
	switch(type) {
		case 'success':
			title = 'Success';
			icon = 'fa fa-check';
			color = 'green';
			break;
		case 'info':
			title = 'Info';
			icon = 'fa fa-info-circle';
			color = 'blue';
			break;
		case 'warning':
			title = 'Warning';
			icon = 'fa fa-warning';
			color = 'yellow';
			break;
		case 'error':
			title = 'Error';
			icon = 'fa fa-exclamation-triangle';
			color = 'red';
			break;
		default:
			title = 'Success';
			icon = 'fa fa-check';
			color = 'green';
			break;
	}
	if(theme !== 'dark') theme = 'light';

	var obj = $.dialog({
    title: title,
    content: content,
		icon: icon,
		type: color,
		closeIcon: true,
    typeAnimated: true,
		offsetBottom: 450,
		backgroundDismiss: true,
		theme: theme,
	});

	setTimeout(function(){
		obj.close();
	}, 2000); 
}

// CONFIRM MESSAGE WITH JQ CONFIRM
var confirmMsg = function(param) {
	var title = 'Confirm!';
	var content = 'Are you sure?';
	var autoClose = 'cancel|10000';
	var confirmText = '<i class="fa fa-trash"></i> Delete';
	var confirmAction = function() { alertMsg('Deleted', 'success'); }
	var cancelAction = '';

	if(param) {
		if(param.title) title = param.title;
		if(param.content) content = param.content;
		if(param.autoClose) autoClose = param.autoClose;
		if(param.confirmText) confirmText = param.confirmText;
		if(param.confirmAction) confirmAction = param.confirmAction;
		if(param.cancelAction) cancelAction = param.cancelAction;
	}
	if(theme !== 'dark') theme = 'light';

	$.confirm({
		title: title,
    content: content,
		icon: 'fa fa-warning',
		type: 'red',
    typeAnimated: true,
    backgroundDismissAnimation: 'glow',
		offsetBottom: 400,
		autoClose: autoClose,
		theme: theme,
    buttons: {
			confirm: {
				text: confirmText,
				btnClass: 'btn-danger',
				action: confirmAction
			},
			cancel: {
				action: cancelAction
			}
    }
	});
}

// RESPONSE API ALERT
var resAlert = function(errors) {
	toastr.options = {
		timeOut: 3000,
		"positionClass": "toast-top-center",
		"preventDuplicates": false
	}

	if(errors) {
		if(errors.status !== undefined && errors.status !== true) {
			switch(errors.status) {
				case 400: type = 'warning'; break;
				case 401: type = 'warning'; break;
				case 403: type = 'warning'; break;
				case 404: type = 'error'; break;
				case 405: type = 'error'; break;
				case 406: type = 'error'; break;
				case 500: type = 'error'; break;
				default: type = 'info'; break;
			}
			title = errors.statusText;
			if(errors.responseJSON['message']) {
				message = errors.responseJSON['message'];
			} else {
				message = errors.responseJSON['error'];
			}
		} else {
			type = 'success';
			title = 'Success';
			message = errors.message;
		}

		toastr[type](message, title);
	}
}


// SET ERROR VALIDATION SERVER
var errValidServer = function(form, errors) {
	if(errors.responseJSON.errors) {
		res = errors.responseJSON.errors[0];
		$.each(res, function(key, val) {
			elm = '<small class="text-danger error">'+val+'</small>';
			input = $(form).find('[name="'+key+'"]');
			$(input).parents('.form-group').find('small.error').remove();
			$(input).parents('.form-group').append(elm);
		})
	}

	setTimeout(function() {
		$('small.error').remove();
	}, 20000);
}

// PREVIEW INPUT IMG
var previewImg = function(param) {
	if (param.input.files && param.input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			if(param.type === 'src') {
				$(param.preview).attr('src', e.target.result);
			} else {
				background = 'url('+e.target.result+')';
				$(param.preview).css('background-image', background);
			}
			$(param.preview).show();
		}
		reader.readAsDataURL(param.input.files[0]);
	}
}

var showPass = function(dis) {
	parent = $(dis).parent().parent();
	pass = $(parent).find('input[name=password]');
	if(pass.length == 0) pass = $(parent).find('input[name=new_password]');
	if(pass.prop('type') === 'password') {
		$(pass).attr('type', 'text');
		$(dis).children('i').removeClass('fa fa-eye');
		$(dis).children('i').addClass('fa fa-eye-slash');
	} else {
		$(pass).attr('type', 'password');
		$(dis).children('i').removeClass('fa fa-eye-slash');
		$(dis).children('i').addClass('fa fa-eye');
	}
}

var showConf = function(dis) {
	parent = $(dis).parent().parent();
	pass = $(parent).find('input[name=passconf]');
	if(pass.length == 0) pass = $(parent).find('input[name=new_passconf]');
	if(pass.prop('type') === 'password') {
		$(pass).attr('type', 'text');
		$(dis).children('i').removeClass('fa fa-eye');
		$(dis).children('i').addClass('fa fa-eye-slash');
	} else {
		$(pass).attr('type', 'password');
		$(dis).children('i').removeClass('fa fa-eye-slash');
		$(dis).children('i').addClass('fa fa-eye');
	}
}

// SET MAX VALUE BIRTH OF DAY
var setMaxBirth = function(elm) {
	let now = new Date();
	let min = new Date(now);
	min.setFullYear(min.getFullYear() - 17);
	string = min.toISOString().split('T')[0].split('-');
	max = `${string[0]}-${string[1]}-${string[2]}`;
	$(elm).attr('max', max);
}

// SET AUTOCOMPLETE, PARAM REQUIRED
var setAutoComplete = function(param) {
	var element = document.querySelector(param.trigger);
	var id = 'autocomplete-default'
	accessibleAutocomplete({
		displayMenu: 'overlay',
		element: element,
		id: id,
		name: param.inputName,
		minLength: 2,
		placeholder: param.inputHolder,
		showNoOptionsFound: false,
		source: param.data,
		menuAttributes: {
			"aria-labelledby": id
		}
	})

	// STOP SLIMSCROLL WHEN ELEMENT AUTOCOMPLETE MOUSEWHEEL
	$('.autocomplete__menu').on('mousewheel', function(e){
		e.stopPropagation();
	});

	$('.autocomplete__menu--visible').slimScroll({
		height: '100%',
		size: '7px',
		distance: '2px',
		wheelStep: 13,
	});
}


// SETTING SELECT2 WITH PARAM DATA AND ELM INPUT
var configSelect2 = function(input, data, value) {
	dataElm = $(input).data();
	config = {};
	config['data'] = data;
	for(const key in dataElm) {
		if(key == 'modal') {
			config['dropdownParent'] = $(dataElm[key]);
		} else if(key == 'value') {
			value = dataElm[key].split(",");
		} else {
			config[key] = dataElm[key];
		}
	}
	// config['containerCssClass'] = 'col-8';
	$(input).empty();
	$(input).select2(config);
	if(value) {
		$(input).val(value);
		$(input).trigger('change');
	}
	// console.log(value);
}
var setSelect2 = function(param) {
	if(param) {
		if(Array.isArray(param)) {
			param.forEach(function(valPar) {
				if(valPar.input.indexOf(', ') > -1) {
					input = valPar.input.split(', ');
					input.forEach(function(valInp) {
						configSelect2(valInp, valPar.data, valPar.value);
					})
				} else {
					configSelect2(valPar.input, valPar.data, valPar.value);
				}
			})
			// console.log(param);
		} else {
			if(param.input.indexOf(', ') > -1) {
				input = param.input.split(', ');
				input.forEach(function(val) {
					configSelect2(val, param.data, param.value);
				})
			} else {
				configSelect2(param.input, param.data, param.value);
			}
		}
	}
}

/**
 * MODAL
 */
var modalReset = function(modal) {
	$(modal).on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
	});
	$(modal).modal('hide');
}


/**
 * CLEAR
 */
var navLogout = function() {
	confirmMsg({
		title: 'Logout!',
		content: 'Are you sure want to Logout?',
		confirmText: '<i class="fa fa-sign-out"></i> Logout',
		confirmAction: function() {
			logout();
		}
	})
}

var logout = function() {
	$.ajax({
		url: baseUrl()+'api/logout',
		type: 'get',
		dataType: 'json',
		success: function(res) {
			resAlert(res);
			setTimeout(function() {
				sessionStorage.clear();
				localStorage.clear();
				window.location.href = baseUrl();
			}, 2000);
		},
		error: function(err) {
			resAlert(err);
		},
	})
}
