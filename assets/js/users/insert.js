


let BASE_URL = baseUrl();
$(document).ready(function() {
	$('#preview-cover').attr('style', 'background-image: url('+baseUrl()+'assets/img/cover-default.jpg)');
	$('#preview-avatar').attr('src',baseUrl()+'assets/img/avatar-default.jpg');

	// SET MAX BIRTH DAY
	setMaxBirth('input[name=tgl_lahir]');

	// SET SELECT2
	var optGender = [
		{id:'laki-laki', text:'Laki-Laki'},
		{id:'perempuan', text:'Perempuan'}];
	var parSelect2 = [
		{ input:'#tempat-lahir, #domisili', data:kabupaten() },
		{ input:'#jenis-kelamin', data:optGender },
		{ input:'#rule-input', data:rules() }
	];
	setSelect2(parSelect2);

	// SET AUTOCOMPLETE
	setAutoComplete({
		trigger: '#auto-profesi',
		inputName: 'profesi',
		inputHolder: 'Enter Profesion',
		data: profesi()
	});
});

var kabupaten = function() {
	if(!getLocal('param_loc')) {
		data = parLoc();
		setLocal('param_loc', data);
		return data;
	} else {
		return getLocal('param_loc');
	}
}

var profesi = function() {
	if(!getLocal('param_profesi')) {
		data = parProfesi();
		setLocal('param_profesi', data);
		return data;
	} else {
		return getLocal('param_profesi');
	}
}

var rules = function() {
	if(!getLocal('param_rules')) {
		data = parRules();
		setLocal('param_rules', data);
		return data;
	} else {
		return getLocal('param_rules');
	}
}

$("input#cover").on('change', function() {
	previewImg({
		'input': this,
		'preview': '#preview-cover',
		'type': 'background'
	});
});

$("input#avatar").on('change', function() {
	previewImg({
		'input': this,
		'preview': '#preview-avatar',
		'type': 'src'
	});
});

$('form#add-user').on('submit', function(e) {
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: BASE_URL+'api/main/users',
		type: 'post',
		dataType: 'json',
		data: formData,
		enctype: 'multipart/form-data',
		cache: false,
		contentType: false,
		processData: false,
		success: function(res) {
			alertMsg(res.message);
			delLocal('param_profesi');
			setTimeout(function() {
				window.location.href = BASE_URL+'users';
			}, 1000);
		},
		error: function(err) {
			resAlert(err);
			errValidServer($('form#add-user'), err);
			errors = err.responseJSON.errors;
			$('#err-cover').html(errors.cover);
			$('#err-avatar').html(errors.avatar);
			setTimeout(function() {
				$('#err-cover').html('');
				$('#err-avatar').html('');
			}, 20000);
		},
	})

})

