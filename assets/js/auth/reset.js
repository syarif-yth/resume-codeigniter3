


let BASE_URL = baseUrl();
$(document).ready(function() {
})

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Reset password success');
	setTimeout(function() {
		window.location.href = BASE_URL+'../';
  }, 2000);
})
