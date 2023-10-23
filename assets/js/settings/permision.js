


let BASE_URL = baseUrl();
var dtTable;
$(document).ready(function() {
	setAction('api/settings/permision');
	function childDetail(data, col) {
		var elmLi = '';
		var act = data.action; 
		var value = Array();
		if(col === 'details-class') {
			value = data['class'];
			$.each(value, function(key, val) {
				if(act['edit-class']==undefined) {
					elmLi += '<li class="">'+data['label_class'][key]+'</li>';
				} else {
					elmLi += '<li type="button" class="btn hover-secondary" data-target="#modal-class" data-toggle="modal" data-value="'+val+'" data-parent="'+data['nama']+'">'+data['label_class'][key]+'<span class="caret"></span></li>';
				}
			});
			btnEdit = '<button type="button" data-target="#modal-'+col+'" data-toggle="modal" data-parent="'+data['nama']+'" data-value="'+value+'" class="btn btn-secondary m-r-5"><i class="fa fa-pencil"></i> Edit</button>';
			if(act['detail-class']==undefined) btnEdit='';

		} else if(col === 'details-nav') {
			value = data['navigasi'];
			$.each(value, function(key, val) {
				elmLi += '<li class="">'+val+'</li>';
			});
			btnEdit = '<button type="button" data-target="#modal-'+col+'" data-toggle="modal" data-parent="'+data['nama']+'" data-value="'+value+'" class="btn btn-secondary m-r-5"><i class="fa fa-pencil"></i> Edit</button>';
			if(act['detail-nav']==undefined) btnEdit='';
		}

		return (
			'<table class="details">'+
				'<tr>'+
					'<td><ul class="tag-child">'+elmLi+'<li></li></ul></td>'+
					'<td>'+btnEdit+'</td>'+
				'</tr>'+
			'</table>'
		);
	}

	dtTable = $('#rules_table').DataTable({
		ajax: {
			url: BASE_URL+'api/settings/permision/datatable',
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
			{ data: 'navigasi', orderable: false,
				class: 'dt-control control-nav',
				render: function(data, type, row, meta) {
					return data.length;
				}
			},
			{ data: 'class', orderable: false,
				class: 'dt-control control-class',
				render: function(data, type, row, meta) {
					return data.length;
				}
			},
			{ data: 'users', orderable: false, class: 'center' },
			{ data: 'action', orderable: false, class: 'action-sm',
				render: function(data, type, row, meta) {
					btnEdit = '<button type="button" class="btn btn-secondary btn-custom"  data-target="#edit-data" data-toggle="modal" data-row="'+meta.row+'">'+
						'<i class="fa fa-edit"></i>'+
					'</button>';
					btnDel = '<button type="button" class="btn btn-secondary btn-custom" onclick="del(this)" data-rule="'+row['nama']+'">'+
						'<i class="fa fa-trash"></i>'+
					'</button>';

					if(data.edit==undefined) btnEdit='';
					if(data.delete==undefined) btnDel='';

					return '<div class="btn-group">'+
						btnEdit+
						btnDel+
					'</div>';
				}
			}
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

	var detailRows = [];
	dtTable.on('click', 'tbody td.dt-control', function (event) {
		let tr = event.target.closest('tr');
    let row = dtTable.row(tr);
    let idx = detailRows.indexOf(tr);
		let col = $(this).data('col');
		let isOpen = tr.classList;
		
		if(isOpen[2] === col) {
			tr.classList.remove('details-nav');
			tr.classList.remove('details-class');
			tr.classList.remove('details');
			row.child.hide();
			detailRows.splice(idx, 1);
		} else {
			tr.classList.add('details');
			if(col === 'details-nav') {
				tr.classList.remove('details-class');
				tr.classList.add('details-nav');
				row.child(childDetail(row.data(), col)).show();
			} 

			if(col === 'details-class') {
				tr.classList.remove('details-nav');
				tr.classList.add('details-class');
				row.child(childDetail(row.data(), col)).show();
			} 

			if (idx === -1) { detailRows.push(tr); } 
		}

		$('.tag-child li').each(function() {
			$(this).addClass(randomBg());
		});
	});

	
});

$('#new-data').on('show.bs.modal', function(event) {
	var parSelect2 = [{ input: '#navigasi-new', data: parNav() },
		{ input: '#class-new', data: parClass() }];
	setSelect2(parSelect2);
})

$('#edit-data').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var row = button.data('row');
	var data = dtTable.row(row).data();

	$(this).find('input[name=id]').val(data.action);
	$(this).find('input[name=nama]').val(data.nama);
	$(this).find('input[name=nama_old]').val(data.nama);
	$(this).find('input[name=label]').val(data.label);
	if(data.users !== '0') {
		$(this).find('input[name=nama]').attr('readonly',true);
	} else {
		$(this).find('input[name=nama]').attr('readonly',false);
	}

	var parSelect2 = [
		{ input: '#navigasi-edit', data: parNav(), value: data.navigasi },
	];
	setSelect2(parSelect2);
})

var del = function(th) {
	var getRule = $(th).data('rule');
	confirmMsg({
		title: 'Delete!',
		content: 'Are you sure want to Delete Rule "'+getRule+'"?',
		confirmText: '<i class="fa fa-trash"></i> Delete',
		confirmAction: function() {
			deleteRules(getRule);
		}
	});
}

/**
 * EVENT MODAL SHOW
 */
$('#modal-details-nav').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var getRule = button.data('parent');
	var getValue = button.data('value');
	$(this).find('input[name=rule]').val(getRule);

	var parSelect2 = { 
		input : '#input-navigasi', 
		data : parNav(),
		value : getValue.split(",")
	};
	setSelect2(parSelect2);
})

$('#modal-details-class').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var getRule = button.data('parent');
	var getValue = button.data('value');
	$(this).find('input[name=rule]').val(getRule);

	var parSelect2 = { 
		input : '#input-class', 
		data : parClass(),
		value : getValue.split(",")
	};
	setSelect2(parSelect2);
})

$('#modal-class').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	var getRule = button.data('parent');
	var getVal = button.data('value');
	var getText = button.text();
	$(this).find('input[name=rule]').val(getRule);
	$(this).find('input[name=class]').val(getVal);
	$(this).find('h4.modal-title').html('Detail Class '+getText);

	get = getDetailClass(getRule, getVal);
	setElmChild(get.child);
	var parSelect2 = [
		{ input: '#input-method', data: parMethod(), value: get.method },
		{ input: '#input-aksi', data: parAksi(), value: get.aksi },
		{ input: '.input-child', data: parChild(getVal) }
	];
	setSelect2(parSelect2);
})

/**
 * CUSTOMIZE THEME
 */
var addChild = function(th) {
	tr = $('#child-class tbody').find('tr');
	key = tr.length;
	elmChild(key, null, null, false);
	form = $(th).parents('form');
	getClass = $(form).find('input[name=class]').val();
	var parSelect2 = { input: '.input-child', data: parChild(getClass) };
	setSelect2(parSelect2);
}

var delRow = function(th) {
	tr = $(th).parents('tr');
	$(tr).remove();
}

var elmChild = function(numb, key, val, set) {
	dtVal = (set) ? key : '';
	tr = '<tr>'+
		'<td>'+
			'<input class="form-control input-child" name="child['+numb+']" data-placeholder="Select Child" data-modal="#modal-class" value="'+dtVal+'">'+
		'</td>'+
		'<td>'+
			'<select class="form-control method-child-'+key+'" name="method_child['+numb+'][]" multiple="multiple" data-placeholder="Select Method"></select>'+
		'</td>'+
		'<td>'+
			'<button type="button" class="btn hover-danger btn-secondary pull-right" onclick="delRow(this)"><i class="fa fa-close"></i></button>'+
		'</td>'+
	'</tr>';
		
	$('#child-class tbody').append(tr);
	var parSelect2 = { input: '.method-child-'+key, data: parMethod(), value: val };
	setSelect2(parSelect2);
}

var setElmChild = function(data) {
	$('#child-class tbody tr').remove();
	var no = 0;
	$.each(data, function(key, val) {
		elmChild(no, key, val, true);
		no++;
	})
}

/**
 * VALIDATION FORM
 */
$('form#new-rules').validate({
	errorClass: 'form-control-feedback',
	errorElement: 'small',
	errorPlacement: function(err, th) {
		$(th).parents('.form-group').append(err);
	}
})

/**
 * SUBMIT EVENT AND AJAX
 */

var getDetailClass = function(rule, kelas) {
	data = Array;
	$.ajax({
		url: BASE_URL+'api/settings/permision/detail',
		type: 'post',
		dataType: 'json',
		async: false,
		data: { rule: rule, class: kelas },
		success: function(res) {
			data = res.data;
		},
		error: function(err) {
			resAlert(err);
		},
	})
	return data;
}

$('form#new-rules').on('submit', function(e) {
	e.preventDefault();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/settings/permision',
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
				errValidServer($('form#new-rules'), err);
			},
		})
	}
})

var deleteRules = function(key) {
	$.ajax({
		url: BASE_URL+'api/settings/permision',
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

$('form#edit-rules').on('submit', function(e) {
	e.preventDefault();
	rule = $(this).find('input[name=nama]').val();
	if($(this).valid() == true) {
		$.ajax({
			url: BASE_URL+'api/settings/permision',
			type: 'put',
			dataType: 'json',
			data: $(this).serializeArray(),
			success: function(res) {
				alertMsg(res.message);
				modalReset('#edit-data');
				dtTable.draw();
				userLog = loginAs();
				if(userLog.rule === rule) {
					reloadNavi();
				}
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form#edit-rules'), err);
			},
		})
	}
})

$('form#modify-nav').on('submit', function(e) {
	e.preventDefault();
	rule = $(this).find('input[name=rule]').val();
	$.ajax({
		url: BASE_URL+'api/settings/permision/nav',
		type: 'put',
		dataType: 'json',
		data: $(this).serializeArray(),
		success: function(res) {
			alertMsg(res.message);
			$('#modal-details-nav').modal('hide');
			dtTable.draw();
			userLog = loginAs();
			if(userLog.rule === rule) {
				reloadNavi();
			}
		},
		error: function(err) {
			resAlert(err);
		},
	})
})


$('form#modify-class').on('submit', function(e) {
	e.preventDefault();
	$.ajax({
		url: BASE_URL+'api/settings/permision/class',
		type: 'put',
		dataType: 'json',
		data: $(this).serializeArray(),
		success: function(res) {
			alertMsg(res.message);
			$('#modal-details-class').modal('hide');
			dtTable.draw();
		},
		error: function(err) {
			resAlert(err);
		},
	})
})

$('form#modify-method').on('submit', function(e) {
	e.preventDefault();
	$.ajax({
		url: BASE_URL+'api/settings/permision/method',
		type: 'put',
		dataType: 'json',
		data: $(this).serializeArray(),
		success: function(res) {
			alertMsg(res.message);
			$('#modal-class').modal('hide');
			dtTable.draw();
		},
		error: function(err) {
			resAlert(err);
		},
	})
})


