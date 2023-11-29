


let BASE_URL = baseUrl();
let dtTable;
$(document).ready(function() {
	setAction('api/main/users');
	dtTable = $('#users_table').DataTable({
		ajax: {
			url: BASE_URL+'api/main/users/datatable',
			type: 'post',
			error: function(err) { errorPage(err) }
		},
    processing: true,
    serverSide: true,
		retrieve: true,
		columns: [
			{ data: 'no', orderable: false },
			{ data: 'nama' },
			{ data: 'username' },
			{ data: 'email' },
			{ data: 'profesi' },
			{ data: 'status', orderable: false, class: 'center' },
			{ data: 'action', orderable: false, class: 'action-sm',
				render: function(data, type, row, meta) {
					btnEdit = '<button type="button" class="btn btn-secondary btn-custom" onclick="edit(this)" data-key="'+data.nip+'"><i class="fa fa-edit"></i></button>';
					btnDel = '<button type="button" class="btn btn-secondary btn-custom" data-key="'+data.nip+'" data-nama="'+row['nama']+'" data-target="#modal-close" data-toggle="modal"><i class="fa fa-trash"></i></button>';

					if(data.edit==undefined) btnEdit='';
					if(data.delete==undefined) btnDel='';

					return '<div class="btn-group">'+
						btnEdit+
						btnDel+
					'</div>';
				}
			}
		],
	});
});


$('form#close-account').on('submit', function(e) {
	e.preventDefault();
	var array = $(this).serializeArray();
	var type = array[4].value;
	var nama = array[1].value;

	confirmMsg({
		title: 'Close '+type+'!',
		content: 'Are you sure want to Close '+type+' User "'+nama+'"?',
		confirmText: '<i class="fa fa-trash"></i> Confrim',
		confirmAction: function() {
			// deleteUsers(key);
			closeAccount(array);
		}
	})
	// console.log(type);
	return false;
});

const closeAccount = function(array) {
	$.ajax({
		url: BASE_URL+'api/main/users/close',
		type: 'delete',
		dataType: 'json',
		data: array,
		success: function(res) {
			console.log(res);
			// alertMsg(res.message);
			// dtTable.draw();
		},
		error: function(err) {
			resAlert(err);
			errValidServer($('form#close-account'), err);
		},
	})
}

const del = function(th) {
	var nama = $(th).data('nama');
	var key = $(th).data('key');
	confirmMsg({
		title: 'Delete!',
		content: 'Are you sure want to Delete User "'+nama+'"?',
		confirmText: '<i class="fa fa-trash"></i> Delete',
		confirmAction: function() {
			// deleteUsers(key);
		}
	})
}

const edit = function(th) {
	var key = $(th).data('key');
	window.location.href = BASE_URL+'users/edit/'+key;
}

var deleteUsers = function(key) {
	$.ajax({
		url: BASE_URL+'api/main/users',
		type: 'delete',
		dataType: 'json',
		data: { key:key },
		success: function(res) {
			alertMsg(res.message);
			dtTable.draw();
		},
		error: function(err) {
			resAlert(err);
		},
	})
}


