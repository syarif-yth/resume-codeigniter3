

$(document).ready(function() {
	$("#pilih").on('change', function() {
		readURL(this);
  });
});

function readURL(input)
{
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$("img#preview").attr('src', e.target.result);
			$("img#preview").show();
		}
		reader.readAsDataURL(input.files[0]);
	}
}

