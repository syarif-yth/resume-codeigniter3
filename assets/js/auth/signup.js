


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
	});

	submitBtn = $('form button[type=submit]');
	submitBtn.attr('disabled', true);
	$('input#agree').on('change', function() {
		checked = $(this).is(':checked');
		if(checked == true) {
			submitBtn.removeAttr('disabled');
		} else {
			submitBtn.attr('disabled', true);
		}
	})
})

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Signup success');
	setTimeout(function() {
    window.location.href = BASE_URL+'activation';
  }, 2000);
})
