



let BASE_URL = baseUrl();
let dtTable;
$(document).ready(function() {
	setAction('api/settings/navigation');
	dtTable = $('#navigasi_table').DataTable({
		ajax: {
			url: BASE_URL+'api/settings/navigation/datatable',
			type: 'post',
		},
    processing: true,
    serverSide: true,
		retrieve: true,
		columns: [
			{ data: 'no', orderable: false },
			{ data: 'group' },
			{ data: 'nama' },
			{ data: 'label' },
			{ data: 'url' },
			{ data: 'icon', orderable: false, class: 'center', 
				render: function(data) {
					return '<i class="'+data+'"></i>';
				}
			},
			{ data: 'sorting', class: 'center' },
			{ data: 'action', orderable: false, class: 'action-sm',
				render: function(data, type, row, meta) {
					btnEdit = '<button type="button" class="btn btn-secondary btn-custom"  data-target="#edit-data" data-toggle="modal" data-row="'+meta.row+'"><i class="fa fa-edit"></i></button>';
					btnDel = '<button type="button" class="btn btn-secondary btn-custom" onclick="del(this)" data-key="'+data.id+'" data-nama="'+row['nama']+'"><i class="fa fa-trash"></i></button>';

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

})

/**
 * EVENT MODAL SHOW
 */
$('#edit-data').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var row = button.data('row');
	var data = dtTable.row(row).data();

	$(this).find('input[name=id]').val(data.action);
	$(this).find('input[name=group]').val(data.group);
	$(this).find('input[name=nama]').val(data.nama);
	$(this).find('input[name=nama_old]').val(data.nama);
	$(this).find('input[name=label]').val(data.label);
	$(this).find('input[name=url]').val(data.url);
	$(this).find('input[name=icon]').val(data.icon);
	$(this).find('input[name=urutan]').val(data.sorting);
	$(this).find('input[name=urutan_old]').val(data.sorting);
})

/**
 * VALIDATION FORM
 */
$('form#new-nav').validate({
	errorClass: 'form-control-feedback',
	errorElement: 'small',
	errorPlacement: function(err, th) {
		$(th).parents('.form-group').append(err);
	}
})

$('form#edit-nav').validate({
	errorClass: 'form-control-feedback',
	errorElement: 'small',
	errorPlacement: function(err, th) {
		$(th).parents('.form-group').append(err);
	}
});

/**
 * CONFIRM
 */
var del = function(th) {
	var key = $(th).data('key');
	var nama = $(th).data('nama');
	confirmMsg({
		title: 'Delete!',
		content: 'Are you sure want to Delete Navigation "'+nama+'"?',
		confirmText: '<i class="fa fa-trash"></i> Delete',
		confirmAction: function() {
			deleteNav(key);
		}
	});
}

/**
 * SUBMIT FORM AND AJAX
 */
$('form#new-nav').on('submit', function(e) {
	e.preventDefault();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/settings/navigation',
			type: 'post',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				modalReset('#new-data');
				dtTable.draw();
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}
})

$('form#edit-nav').on('submit', function(e) {
	e.preventDefault();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/settings/navigation',
			type: 'put',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				modalReset('#edit-data');
				dtTable.draw();
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
			},
		})
	}
})

var deleteNav = function(key) {
	$.ajax({
		url: BASE_URL+'api/settings/navigation',
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
