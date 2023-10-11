


let BASE_URL = baseUrl();
$(document).ready(function() {

});

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
			url: BASE_URL+'api/recovery',
			type: 'post',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				setTimeout(function() {
					window.location.href = BASE_URL+'recovery/success';
				}, 2000);
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}
})
