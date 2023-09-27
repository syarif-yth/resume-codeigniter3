


let BASE_URL = baseUrl();
$(document).ready(function() {
	$('#show-pass').on('click', function() {
		pass = document.getElementById("password");
		if(pass.type === "password") {
			pass.type = "text";
			$('#show-pass i').removeClass('fa fa-eye');
			$('#show-pass i').addClass('fa fa-eye-slash');
		} else {
			pass.type = "password";
			$('#show-pass i').removeClass('fa fa-eye-slash');
			$('#show-pass i').addClass('fa fa-eye');
		}
	})
})

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Login success, wait for goes to dashboard');
	setTimeout(function() {
    window.location.href = BASE_URL+'dashboard';
  }, 2000);
})
