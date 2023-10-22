



let BASE_URL = baseUrl();
$(document).ready(function() {
	table = $('#navigasi_table').DataTable({
		ajax: {
			url: BASE_URL+'api/settings/navigasi/datatable',
			type: 'post',
		},
    processing: true,
    serverSide: true,
		retrieve: true,
		columnDefs: [{
      "targets"  : [0],
      "orderable": false,
    }],
		columns: [{ data: [0] },
			{ data: [1] },
			{ data: [2] },
			{ data: [3] },
			{ data: [4] },
			{ data: [5], orderable: false, class: 'center' },
			{ data: [6], orderable: false, class: 'action-sm' }
		],
		columnDefs: [{ targets: 3,
				createdCell:  function(td, cellData, rowData, row, col) {
					$(td).attr('data-col', 'details-nav'); 
				}
			},
			{ targets: 4,
				createdCell:  function(td, cellData, rowData, row, col) {
					$(td).attr('data-col', 'details-class'); 
				}
			}
		],
	});
})
