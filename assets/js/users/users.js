


let BASE_URL = baseUrl();
$(document).ready(function() {
	data = getData();

	dataAksi = data.users.aksi;
	var table = $('#users_table').DataTable({
		columns: [
			{ data: 'no', render: function (data, type, row, meta) {
					return meta.row+1;
				}
			},
			{ data: 'nama' },
			{ data: 'username' },
			{ data: 'email' },
			{ data: 'profesi' },
			{ data: 'nip', render: function (data, type, row) {
					btnView = '<button type="button" class="btn btn-secondary btn-custom" onclick="view('+data+')">'+
						'<i class="fa fa-eye"></i>'+
					'</button>';

					btnEdit = '<button type="button" class="btn btn-secondary btn-custom" onclick="edit('+data+')">'+
						'<i class="fa fa-edit"></i>'+
					'</button>';

					btnDel = '<button type="button" class="btn btn-secondary btn-custom" onclick="del('+data+')">'+
						'<i class="fa fa-trash"></i>'+
					'</button>';

					btnAksi = '';
					$.each(dataAksi, function(key, val) {
						if(val=='view') { btnAksi += btnView; }
						if(val=='edit') { btnAksi += btnEdit; }
						if(val=='delete') { btnAksi += btnDel; }
					})
					return '<div class="btn-group">'+btnAksi+'</div>';
				} 
			}
		],
		columnDefs: [{
      "targets"  : 'no-sort',
      "orderable": false,
    }]
	});
	table.clear();
	table.rows.add(data.users.table).draw();
});

var edit = function() {
	window.location.href = BASE_URL+'users/edit';
}

var view = function(nip) {
	console.log(nip);
	// window.location.href = BASE_URL+'users/view';
}

var del = function() {
	confirmMsg();
}

$('#pdf').on("click", function() {
	alertMsg('This is success message');
});


var getData = function() {
	data = Array();
	$.ajax({
		url: BASE_URL+'api/users',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		},
		error: function(err) {
			console.log(err);
			// resAlert(err);
			// errValidServer($('form'), err);
		},
	})
	return data;
}

