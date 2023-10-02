


let BASE_URL = baseUrl();
$(document).ready(function() {
	
});

$("input#cover").on('change', function() {
	previewImg({
		'input': this,
		'preview': '#preview-cover',
		'type': 'background'
	});
});

$("input#avatar").on('change', function() {
	previewImg({
		'input': this,
		'preview': '#preview-avatar',
		'type': 'src'
	});
});

var showPass = function() {
	pass = document.getElementsByClassName("password");
	conf = document.getElementsByClassName("passconf");
	if (pass.type === "password" && conf.type === "password") {
		pass.type = "text";
		conf.type = "text";
		$('#show-pass i').removeClass('fa fa-eye');
		$('#show-pass i').addClass('fa fa-eye-slash');
	} else {
		pass.type = "password";
		conf.type = "password";
		$('#show-pass i').removeClass('fa fa-eye-slash');
		$('#show-pass i').addClass('fa fa-eye');
	}
}

$('form#edit-email').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Link recovery has been send');
	setTimeout(function() {
		$('#modal-email').modal('hide');
  }, 2000);
})

$('form#edit-username').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Link recovery has been send');
	setTimeout(function() {
		$('#modal-username').modal('hide');
  }, 2000);
})

$('form#edit-password').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Link recovery has been send');
	setTimeout(function() {
		$('#modal-reset').modal('hide');
  }, 2000);
})

$('form#edit-profile').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Your profile has been updated');
	setTimeout(function() {
		window.location.href = BASE_URL+'profile';
  }, 2000);
})



