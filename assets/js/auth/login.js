


let BASE_URL = baseUrl();
$(document).ready(function() {
})

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Login success, wait for goes to dashboard');
	setTimeout(function() {
    window.location.href = BASE_URL+'dashboard';
  }, 2000);
})
