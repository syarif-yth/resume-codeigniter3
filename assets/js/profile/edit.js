


let BASE_URL = baseUrl();
$(document).ready(function() {
	// SET MAX BIRTH DAY
	setMaxBirth('input[name=tgl_lahir]');

	// SET SELECT2
	var optLokasi = [{ id: 0, text: 'jakarta'},
		{ id: 1, text: 'bogor' },
    { id: 2, text: 'depok' },
    { id: 3, text: 'tangerang' },
    { id: 4, text: 'bekasi' }];
	var optGender = [{id:'laki-laki', text:'Laki-Laki'},
		{id:'perempuan', text:'Perempuan'}];
	var parSelect2 = [
		{ input:'#tempat-lahir, #domisili', data:optLokasi },
		{ input:'#jenis-kelamin', data:optGender }
	];
	setSelect2(parSelect2);

	// SET AUTOCOMPLETE
	var dummy = [
		"ActionScript","AppleScript","Asp","BASIC",
		"C","C++","Clojure","COBOL","ColdFusion",
		"Erlang","Fortran","Groovy","Haskell",
		"Java","JavaScript","Lisp","Perl","PHP",
		"Python","Ruby","Scala","Scheme"
	];
	setAutoComplete({
		trigger: '#auto-profesi',
		inputName: 'profesi',
		inputHolder: 'Enter Profesion',
		data: dummy
	});

});

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


// FORM SUBMITED
$('form#edit-email').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Link recovery has been send');
	setTimeout(function() {
		$('#modal-email').modal('hide');
  }, 2000);
})

$('form#edit-username').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Link recovery has been send');
	setTimeout(function() {
		$('#modal-username').modal('hide');
  }, 2000);
})

$('form#edit-password').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Link recovery has been send');
	setTimeout(function() {
		$('#modal-password').modal('hide');
  }, 2000);
})

$('form#close-account').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Close Account Success');
	setTimeout(function() {
		$('#modal-close').modal('hide');
  }, 2000);

	setTimeout(function() {
		logout();
  }, 2000);
})

$('form#edit-profile').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Your profile has been updated');
	setTimeout(function() {
		window.location.href = BASE_URL+'profile';
  }, 2000);
})



