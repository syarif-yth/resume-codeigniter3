


let BASE_URL = baseUrl();
var lastPick;
var rand;
var table;
$(document).ready(function() {
	function childDetail(data, col) {
		var elmLi = '';
		var value = Array();
		if(col === 'details-class') {
			$.each(data[4], function(key, val) {
				elmLi += '<li type="button" class="btn hover-secondary" data-target="#modal-class" data-toggle="modal" data-parent="'+data[1]+'">'+val+'<span class="caret"></span></li>';
			});
			
			value = data[4];
		} else if(col === 'details-nav') {
			$.each(data[3], function(key, val) {
				elmLi += '<li class="">'+val+'</li>';
			});
			value = data[3];
		}

		return (
			'<table class="details">'+
				'<tr>'+
					'<td><ul class="tag-child">'+elmLi+'<li></li></ul></td>'+
					'<td><button type="button" data-target="#modal-'+col+'" data-toggle="modal" data-parent="'+data[1]+'" data-value="'+value+'" class="btn btn-secondary m-r-5"><i class="fa fa-pencil"></i> Edit</button></td>'+
				'</tr>'+
			'</table>'
		);
	}

	table = $('#rules_table').DataTable({
		ajax: {
			url: BASE_URL+'api/settings/permision/datatable',
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
			{ data: [3], orderable: false,
				class: 'dt-control control-nav',
				render: function(data, type, row, meta) {
					return data.length;
				}
			},
			{ data: [4], orderable: false,
				class: 'dt-control control-class',
				render: function(data, type, row, meta) {
					return data.length;
				}
			},
			{ data: [5], orderable: false, class: 'center' },
			{ data: [6], orderable: false, class: 'action-sm',
				render: function(data, type, row, meta) {
					return '<div class="btn-group">'+
						'<button type="button" class="btn btn-secondary btn-custom"  data-target="#edit-data" data-toggle="modal" data-row="'+row+'"  data-nav="'+row[3]+'">'+
							'<i class="fa fa-edit"></i>'+
						'</button>'+
						'<button type="button" class="btn btn-secondary btn-custom" onclick="del(this)" data-rule="'+row[1]+'">'+
							'<i class="fa fa-trash"></i>'+
						'</button>'+
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
	table.on('click', 'tbody td.dt-control', function (event) {
		let tr = event.target.closest('tr');
    let row = table.row(tr);
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
			$(this).addClass(randomColor());
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
	var getNav = button.data('nav');
	var row = button.data('row').split(",");
	var id = row[row.length-1];

	$(this).find('input[name=id]').val(id);
	$(this).find('input[name=nama_old]').val(row[1]);
	$(this).find('input[name=nama]').val(row[1]);
	$(this).find('input[name=label]').val(row[2]);
	if(row[row.length-2] !== '0') {
		$(this).find('input[name=nama]').attr('readonly',true);
	} else {
		$(this).find('input[name=nama]').attr('readonly',false);
	}

	var parSelect2 = [
		{ input: '#navigasi-edit', data: parNav(), value: getNav.split(",") },
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
	var getClass = button.text();
	$(this).find('input[name=rule]').val(getRule);
	$(this).find('input[name=class]').val(getClass);

	get = getDetailClass(getRule, getClass);
	setElmChild(get.child);
	var parSelect2 = [
		{ input: '#input-method', data: parMethod(), value: get.method },
		{ input: '#input-aksi', data: parAksi(), value: get.aksi },
		{ input: '.input-child', data: parChild(getClass) }
	];
	setSelect2(parSelect2);
})
$('#modal-class').on('hide.bs.modal', function() {
	$(this).find('form').trigger('reset');
});

/**
 * CUSTOMIZE THEME
 */
var randomColor = function() {
	var colors = ['bg-primary','bg-success','bg-info','bg-warning','bg-danger','bg-megna','bg-theme','bg-inverse','bg-purple'];
	var rand = colors[Math.floor(Math.random() * colors.length)];
	rand==lastPick?randomColor():rand;
	lastPick = rand;
	return rand;
}

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
$('form').validate({
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
				table.draw();
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
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
			table.draw();
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
				table.draw();
				userLog = loginAs();
				if(userLog.rule === rule) {
					reloadNavi();
				}
			},
			error: function(err) {
				resAlert(err);
				errValidServer($('form'), err);
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
			table.draw();
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
			table.draw();
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
			table.draw();
		},
		error: function(err) {
			resAlert(err);
		},
	})
})


