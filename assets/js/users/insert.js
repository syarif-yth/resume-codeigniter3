


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

$('#show-pass').on('click', function() {
	pass = document.getElementById("password");
	conf = document.getElementById("passconf");
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
});

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('New user has been added');
	setTimeout(function() {
		window.location.href = BASE_URL+'users';
  }, 2000);
})


