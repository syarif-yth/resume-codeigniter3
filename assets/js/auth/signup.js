


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

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Signup success');
	setTimeout(function() {
    window.location.href = BASE_URL+'activation';
  }, 2000);
})
