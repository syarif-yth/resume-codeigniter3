


let BASE_URL = baseUrl();
$(document).ready(function() {
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
	})
})

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Reset password success');
	setTimeout(function() {
		window.location.href = BASE_URL+'../';
  }, 2000);
})
