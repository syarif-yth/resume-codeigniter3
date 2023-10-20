



let BASE_URL = baseUrl();
$(document).ready(function() {
	var table = $('#navigasi_table').DataTable({
		columnDefs: [{
      "targets"  : [0],
      "orderable": false,
    }]
	});
})
