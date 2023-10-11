


let BASE_URL = baseUrl();
// window.onbeforeunload = function(e) { 
// 	if(window.onbeforeunload) {
// 		window.setTimeout(function() {
// 			window.location.href = BASE_URL+'signup';
// 		}, 0); 
// 	}
// 	window.onbeforeunload = null;
// }

$(document).ready(function() {
	countDown(5);
	disableBack();
	disableReload();
	var email = localStorage.getItem("email");
	$('input[name=email]').val(email);
});



function countDown(time)
{
  $('#resend-button a').remove();

  count = '<span id="countdown" class="small">'+time+'</span> <span class="small">seconds to resend code</span>';
  $('#count-group').append(count);

  resendButton = '<a href="javascript:void(0)" onclick="resendCode()">Resend Code</a>';

  var interval = setInterval(function() {
    if(time != 0) {
      $('#countdown').text(time--);
    } else {
      $('#count-group span').remove();
    }
  }, 1000);

  setTimeout(function() {
    clearInterval(interval)
    $('#resend-button').append(resendButton);
  }, 1000*(time+1));
}

function disableBack()
{
	history.pushState(null, null, window.location.href);
	window.onpopstate = () => history.forward();
}

function disableReload()
{
  window.onbeforeunload = null;
}

function resendCode()
{
	countDown(5);
}

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
			url: BASE_URL+'api/activation',
			type: 'post',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				localStorage.removeItem("email");
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


	// alertMsg('Activation success, now your account is active');
	// setTimeout(function() {
	// 	window.location.href = BASE_URL+'dashboard';
  // }, 2000);
})
