


$(document).ready(function() {
	// CONFIG SLIMSCROLL TEMPLATE
	$('.scroller').slimScroll({
		height: '100%',
		size: '7px',
		distance: '2px',
		wheelStep: 13,
	});
	
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

	var obj = $.dialog({
    title: title,
    content: content,
		icon: icon,
		type: color,
		closeIcon: true,
    typeAnimated: true,
		offsetBottom: 450,
		backgroundDismiss: true,
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

	$.confirm({
		title: title,
    content: content,
		icon: 'fa fa-warning',
		type: 'red',
    typeAnimated: true,
    backgroundDismissAnimation: 'glow',
		offsetBottom: 400,
		autoClose: autoClose,
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

// CLEAR
var logout = function() {
  sessionStorage.clear();
  localStorage.clear();
  window.location.href = baseUrl();
}
