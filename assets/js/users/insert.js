


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

$('form#add-user').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Add new user success');
	setTimeout(function() {
		window.location.href = BASE_URL+'users';
  }, 1000);
})
