let BASE_URL = baseUrl();
let dtTable;
$(document).ready(function() {
	setAction('api/settings/classes');
	dtTable = $('#classes_table').DataTable({
		ajax: {
			url: BASE_URL+'api/settings/classes/datatable',
			type: 'post',
			error: function(error) { errorPage(error); }
		},
    processing: true,
    serverSide: true,
		retrieve: true,
		columns: [
			{ data: 'no', orderable: false },
			{ data: 'nama' },
			{ data: 'label' },
			{ data: 'is_child', orderable: false, class: 'center',
				render: function(data) {
					elm = '<span class="bg-danger">No</span>';
					if(data == 1) {
						elm = '<span class="bg-primary">Yes</span>';
					} 
					return elm;
				}
			},
			{ data: 'label_parent', orderable: false, class: 'center col-parent', 
				render: function(data) {
					elm = '';
					if(data == null) {
						elm = '<span class="bg-warning">Is Parent</span>';
					} else {
						array = data.split(",");
						$.each(array, function(key, val) {
							elm += '<span class="'+randomBg()+'">'+val+'</span>';
						})
					}
					return elm;
				}
			},
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

	setParamLocal();
});

var setParamLocal = function() {
	if(!getLocal('param_class')) {
		setLocal('param_class', parClass());
	}
}

$('input#is-child-new').on('change', function() {
	checked = $(this).is(':checked');
	if(checked === true) {
		$('#new-group select').removeAttr('disabled', true);
		$('#new-group').show();

		var parSelect2 = { input: '#parent-new', data: getLocal('param_class') };
		setSelect2(parSelect2);
	} else {
		$('#new-group select').attr('disabled', true);
		$('#new-group').hide();
	}
})

$('input#is-child-edit').on('change', function() {
	nama = $('#edit-data').find('input[name=nama_old]').val();
	isChild = $('#edit-data').find('input[name=ischild_old]').val();
	
	
	checked = $(this).is(':checked');
	if(checked == true) {
		$('#edit-group select').removeAttr('disabled', true);
		$('#edit-group').show();

		forData = (isChild==1) ? getLocal('param_class') : parClassWithout(nama);
		var parSelect2 = { 
			input: '#parent-edit', 
			data: forData,
			value: []
		};
		setSelect2(parSelect2);
	} else {
		$('#edit-group select').attr('disabled', true);
		$('#edit-group').hide();
	}
})

/**
 * EVENT MODAL SHOW
 */
$('#new-data').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
});
$('#edit-data').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var row = button.data('row');
	var data = dtTable.row(row).data();

	$(this).find('input[name=id]').val(data.action['id']);
	$(this).find('input[name=nama]').val(data.nama);
	$(this).find('input[name=nama_old]').val(data.nama);
	$(this).find('input[name=ischild_old]').val(data.is_child);
	$(this).find('input[name=label]').val(data.label);
	
	if(data.is_child == 1) {
		$(this).find('input[name=is_child]').attr('checked', true);
		$(this).find('select#parent-edit').removeAttr('disabled');
		$(this).find('#edit-group').show();
		var parSelect2 = { 
			input: '#parent-edit', 
			data: getLocal('param_class'),
			value: data.parent.split(',')
		};
		setSelect2(parSelect2);
	} else {
		$(this).find('input[name=is_child]').removeAttr('checked');
		$(this).find('select#parent-edit').attr('disabled', true);
		$(this).find('#edit-group').hide();
	}
	
});

/**
 * VALIDATION FORM
 */
$('form#new-param').validate({
	errorClass: 'form-control-feedback',
	errorElement: 'small',
	errorPlacement: function(err, th) {
		$(th).parents('.form-group').append(err);
	}
})

/**
 * FORM SUBMIT AND AJAX
 */
$('form#new-param').on('submit', function(e) {
	e.preventDefault();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/settings/classes',
			type: 'post',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				modalReset('#new-data');
				dtTable.draw();
				manageLocal();
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form#new-param'), err);
			},
		})
	}
})

$('form#edit-param').on('submit', function(e) {
	e.preventDefault();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/settings/classes',
			type: 'put',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				modalReset('#edit-data');
				dtTable.draw();
				manageLocal();
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form#edit-param'), err);
			},
		})
	}
})

var del = function(th) {
	var key = $(th).data('key');
	var nama = $(th).data('nama');
	confirmMsg({
		title: 'Delete!',
		content: 'Are you sure want to Delete Class "'+nama+'"?',
		confirmText: '<i class="fa fa-trash"></i> Delete',
		confirmAction: function() {
			deleteClass(key);
		}
	});
}

var manageLocal = function() {
	if(getLocal('param_class')) {
		data = parClass();
		setLocal('param_class', data);
	}
}

var deleteClass = function(key) {
	$.ajax({
		url: BASE_URL+'api/settings/classes',
		type: 'delete',
		dataType: 'json',
		data: { key:key },
		success: function(res) {
			alertMsg(res.message);
			dtTable.draw();
			manageLocal();
		},
		error: function(err) {
			resAlert(err);
		},
	})
}
