


let BASE_URL = baseUrl();
$(document).ready(function() {
	var table = $('#users_table').DataTable({
		"columnDefs": [{
      "targets"  : 'no-sort',
      "orderable": false,
    }]
	});
});

function edit() {
	window.location.href = BASE_URL+'users/edit';
}

$('#pdf').on("click", function() {
	alertMsg('This is success message');
});

