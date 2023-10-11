


let BASE_URL = baseUrl();
$(document).ready(function() {
	pathArray = window.location.pathname.split('/');
	key = pathArray[pathArray.length-1];
	$('form').attr('data-key', key);
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
	key = $('form').data('key');
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/reset/'+key,
			type: 'put',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				setTimeout(function() {
					window.location.href = BASE_URL;
				}, 3000);
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}
})
