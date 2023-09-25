let BASE_URL = baseUrl();
$(document).ready(function() {
	// CONFIRM TO LEAVE PAGE
	// window.onbeforeunload = function() { return "Your work will be lost."; };

	// DISABLE HISTORY BACK
	history.pushState(null, null, window.location.href);
	history.back();
	window.onpopstate = () => history.forward();

	$('#showpass-log').on('click', function() {
		pass = document.getElementById("password");
		if (pass.type === "password") {
			pass.type = "text";
			$('#showpass-log i').removeClass('fa fa-eye');
			$('#showpass-log i').addClass('fa fa-eye-slash');
		} else {
			pass.type = "password";
			$('#showpass-log i').removeClass('fa fa-eye-slash');
			$('#showpass-log i').addClass('fa fa-eye');
		}
	})

	$('#showpass-sign').on('click', function() {
		pass = document.getElementById("password");
		conf = document.getElementById("passconf");
		if (pass.type === "password" && conf.type === "password") {
			pass.type = "text";
			conf.type = "text";
			$('#showpass-sign i').removeClass('fa fa-eye');
			$('#showpass-sign i').addClass('fa fa-eye-slash');
		} else {
			pass.type = "password";
			conf.type = "password";
			$('#showpass-sign i').removeClass('fa fa-eye-slash');
			$('#showpass-sign i').addClass('fa fa-eye');
		}
	})
})

$('form#login-form').on('submit', function(e) {
	e.preventDefault();
	window.location.href = BASE_URL+'dashboard';
})

$('form#signup-form').on('submit', function(e) {
	e.preventDefault();
	window.location.href = BASE_URL+'dashboard';
})

$('form#recovery-form').on('submit', function(e) {
	e.preventDefault();
	window.location.href = BASE_URL+'recovery/success';
})

$('form#reset-form').on('submit', function(e) {
	e.preventDefault();
	window.location.href = BASE_URL+'../dashboard';
})
