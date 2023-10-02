


let BASE_URL = baseUrl();
$(document).ready(function() {
	var table = $('#users_table').DataTable({
		"columnDefs": [{
      "targets"  : 'no-sort',
      "orderable": false,
    }]
	});
});

var edit = function() {
	window.location.href = BASE_URL+'users/edit';
}

var view = function() {
	window.location.href = BASE_URL+'users/view';
}

var del = function() {
	confirmMsg();
}

$('#pdf').on("click", function() {
	alertMsg('This is success message');
});

