

let BASE_URL = baseUrl();
$(document).ready(function() {
	var table = $('#kabupaten_table').DataTable({
		ajax: {
			url: BASE_URL+'api/tester/datatable',
			type: 'post',
		},
		columns: [
			{ data: [0] },
			{ data: [1] },
			{ data: [2],
				render: function(data, type, row, meta) {
					return data;
				}
			},
		],
    processing: true,
    serverSide: true,
		columnDefs: [{
      "targets"  : [0],
      "orderable": false,
    }],
	});

})
