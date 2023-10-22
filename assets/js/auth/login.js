


let BASE_URL = baseUrl();
$(document).ready(function() {
	checkLogin('profile');
})

var checkLogin = function(redirect) {
	var value = ('; '+document.cookie).split(`; resume_user=`).pop().split(';')[0];
	if(value) {
		window.location.href = BASE_URL+redirect;
	}
}

$.validator.addMethod('cek', function(val, elm) {
	return validate = (value != 'querty') ? false : true; 
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
				alertMsg('Login success, wait for goes to dashboard');
				localStorage.setItem('loginas', JSON.stringify(res.user));
				setTimeout(function() {
					window.location.href = BASE_URL+'profile';
				}, 2000);
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}
})



