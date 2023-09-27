


let BASE_URL = baseUrl();
$(document).ready(function() {

});

$('form').on('submit', function(e) {
	e.preventDefault();
	window.location.href = BASE_URL+'recovery/success';
})
