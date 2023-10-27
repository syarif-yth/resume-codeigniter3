

let BASE_URL = baseUrl();
$(document).ready(function() {
	var table = $('#kabupaten_table').DataTable({
		ajax: {
			url: BASE_URL+'api/app/kabupaten/datatable',
			type: 'post',
			error: function(err) { errorPage(err) }
		},
		columns: [
			{ data: 'no', sortable: false },
			{ data: 'kode' },
			{ data: 'nama',
				render: function(data, type, row, meta) {
					return data;
				}
			},
		],
    processing: true,
    serverSide: true,
	});

})
