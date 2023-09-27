


$('.scroller').slimScroll({
	height: '100%',
	size: '7px',
	distance: '2px',
	wheelStep: 13,
});

$('input#dark-theme').on('change', function() {
	$('body').toggleClass('dark');
})

var baseUrl = function(segment) {
	pathArray = window.location.pathname.split( '/' );
	indexOfSegment = pathArray.indexOf(segment);
	return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/';
}

var alertMsg = function(message, type) {
	toastr.options = {
		"positionClass": "toast-top-center",
		timeOut: 3000,
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "swing",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut",
		"tapToDismiss": false
	}

	switch(type) {
		case 'success':
			toastr.success(message, 'Success');
			break;
		case 'info':
			toastr.info(message, 'Info');
			break;
		case 'warning':
			toastr.warning(message, 'Warning');
			break;
		case 'error':
			toastr.error(message, 'Error');
			break;
		default:
			toastr.success(message, 'Success');
			break;
	}
}
