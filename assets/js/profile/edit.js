


let BASE_URL = baseUrl();
$(document).ready(function() {
	setMaxBirth('input[name=tgl_lahir]');
	var dummy = [
		"ActionScript","AppleScript","Asp","BASIC",
		"C","C++","Clojure","COBOL","ColdFusion",
		"Erlang","Fortran","Groovy","Haskell",
		"Java","JavaScript","Lisp","Perl","PHP",
		"Python","Ruby","Scala","Scheme"
	];

	// setAutoComplete({
	// 	trigger: '#auto-birth',
	// 	inputName: 'tempat_lahir',
	// 	inputHolder: 'Enter Place of Birth',
	// 	data: dummy
	// });

	var data = [
    {
        id: 0,
        text: 'enhancement'
    },
    {
        id: 1,
        text: 'bug'
    },
    {
        id: 2,
        text: 'duplicate'
    },
    {
        id: 3,
        text: 'invalid'
    },
    {
        id: 4,
        text: 'wontfix'
    }
];

	$('.select2').select2({
		placeholder: 'Select an option',
		data: data
	});

	setAutoComplete({
		trigger: '#auto-domisili',
		inputName: 'domisili',
		inputHolder: 'Enter Domicile',
		data: dummy
	});

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
		$('#modal-reset').modal('hide');
  }, 2000);
})

$('form#edit-profile').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Your profile has been updated');
	setTimeout(function() {
		window.location.href = BASE_URL+'profile';
  }, 2000);
})



