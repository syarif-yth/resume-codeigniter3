

$(document).ready(function() {
	var table = $('#users_table').DataTable({
		"columnDefs": [{
      "targets"  : 'no-sort',
      "orderable": false,
    }]
	});
});

