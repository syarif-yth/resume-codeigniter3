


let BASE_URL = baseUrl();
$(document).ready(function() {
	submitBtn = $('form button[type=submit]');
	submitBtn.attr('disabled', true);
})

$('input#agree').on('change', function() {
	checked = $(this).is(':checked');
	if(checked == true) {
		submitBtn.removeAttr('disabled');
	} else {
		submitBtn.attr('disabled', true);
	}
})

$('form').validate({
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
			url: BASE_URL+'api/regist',
			type: 'post',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				localStorage.setItem('email', res.data.email);
				setTimeout(function() {
					window.location.href = BASE_URL+'activation';
				}, 2000);
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}

	// alertMsg('Signup success');
	// setTimeout(function() {
  //   window.location.href = BASE_URL+'activation';
  // }, 2000);
})
