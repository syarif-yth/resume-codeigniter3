



let BASE_URL = baseUrl();
$(document).ready(function() {
	var optLokasi = [{ id: 0, text: 'jakarta'},
		{ id: 1, text: 'bogor' },
    { id: 2, text: 'depok' },
    { id: 3, text: 'tangerang' },
    { id: 4, text: 'bekasi' }];
	var parSelect2 = { input:'#lokasi-filter', data:optLokasi }
	setSelect2(parSelect2);

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


