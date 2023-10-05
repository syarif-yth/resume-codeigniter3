


let BASE_URL = baseUrl();
$(document).ready(function() {
	checkLogin();
})

$.validator.addMethod('cek', function(val, elm) {
	if(value != 'qwerty') {
		return false;
	} else {
		return true;
	}
}, "Amount must be greater than zero");

$('form').validate({
	// rules: {
	// 	'username': { cek: true  },
	// },
	errorClass: 'form-control-feedback',
	errorElement: 'small',
	errorPlacement: function(err, th) {
		$(th).parents('.form-group').append(err);
	}
})


$('form').on('submit', function(e) {
	e.preventDefault();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/login',
			type: 'post',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				sessionStorage.setItem('login', JSON.stringify(res));
				alertMsg('Login success, wait for goes to dashboard');
				setTimeout(function() {
					window.location.href = BASE_URL+'dashboard';
				}, 2000);
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}
})



