


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

$('form').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Activation success, now your account is active');
	setTimeout(function() {
		window.location.href = BASE_URL+'dashboard';
  }, 2000);
})
