


let BASE_URL = baseUrl();
var lastPick;
var rand;
$(document).ready(function() {
	var parSelect2 = [
		{ input:'#parent-func', data:parFunc() },
	];
	setSelect2(parSelect2);
	
	function childNav(data) {
		var elmLi = '';
		$.each(data[3], function(key, val) {
			elmLi += '<li type="button" class="btn hover-secondary">'+val+'</li>';
		});
		return (
			'<table class="details">'+
				'<tr>'+
					'<td><ul class="tag-child">'+elmLi+'<li></li></ul></td>'+
					'<td><button type="button" class="btn hover-danger btn-secondary m-r-5"><i class="fa fa-pencil"></i> Edit</button></td>'+
				'</tr>'+
			'</table>'
		);
	}

	function childFunc(d) {
		return (
			'<table class="details">'+
				'<tr>'+
					'<td><ul class="tag-child">'+
						'<li type="button" class="btn hover-secondary">Resume</li>'+
						'<li type="button" class="btn hover-secondary">Profile</li>'+
						'<li type="button" class="btn hover-secondary">Users</li>'+
						'<li type="button" class="btn hover-secondary">Users</li>'+
						'<li></li>'+
					'</ul></td>'+
					'<td><button type="button" class="btn hover-danger btn-secondary m-r-5"><i class="fa fa-pencil"></i> Edit</button></td>'+
				'</tr>'+
			'</table>'
		);
	}

	var table = $('#rules_table').DataTable({
		ajax: {
			url: BASE_URL+'api/settings/permision',
			type: 'post',
		},
    processing: true,
    serverSide: true,
		columnDefs: [{
      "targets"  : [0],
      "orderable": false,
    }],
		columns: [
			{ data: [0] },
			{ data: [1] },
			{ data: [2] },
			{ data: [3],
				class: 'dt-control control-nav',
				orderable: false,
				render: function(data, type, row, meta) {
					return data.length;
				}
			},
			{ data: [4],
				class: 'dt-control control-func',
				orderable: false,
			},
			{ data: [5],
				orderable: false
			}
		],
		columnDefs: [{ targets: 3,
				createdCell:  function (td, cellData, rowData, row, col) {
					$(td).attr('data-col', 'details-nav'); 
				}
			},
			{ targets: 4,
				createdCell:  function (td, cellData, rowData, row, col) {
					$(td).attr('data-col', 'details-func'); 
				}
			}
		],
	});

	var detailRows = [];
	table.on('click', 'tbody td.dt-control', function () {
		let tr = event.target.closest('tr');
    let row = table.row(tr);
    let idx = detailRows.indexOf(tr);
		let col = $(this).data('col');
		let isOpen = tr.classList;
		
		if(isOpen[2] === col) {
			tr.classList.remove('details-nav');
			tr.classList.remove('details-func');
			tr.classList.remove('details');
			row.child.hide();
			detailRows.splice(idx, 1);
		} else {
			tr.classList.add('details');
			if(col === 'details-nav') {
				tr.classList.remove('details-func');
				tr.classList.add('details-nav');
				row.child(childNav(row.data())).show();
			} 

			if(col === 'details-func') {
				tr.classList.remove('details-nav');
				tr.classList.add('details-func');
				row.child(childFunc(row.data())).show();
			} 

			if (idx === -1) { detailRows.push(tr); } 
		}

		$('.tag-child li').each(function() {
			$(this).addClass(randomColor());
		});
	});


});

var randomColor = function() {
	var colors = ['bg-primary','bg-success','bg-info','bg-warning','bg-danger','bg-megna','bg-theme','bg-inverse','bg-purple'];
	var rand = colors[Math.floor(Math.random() * colors.length)];
	rand==lastPick?randomColor():rand;
	lastPick = rand;
	return rand;
}




var container = document.getElementById("jsoneditor");
var options = {
	mode: 'code',
	name: "jsonContent",
	modes: ['code', 'form', 'tree', 'preview'],
};
var editor = new JSONEditor(container, options);
var json = {
	"users": {
			"aksi": ["add","edit","delete"],
			"method": ["get","post","put"],
			"child": {
				"datatables": ["post","get"],
				"chart": ["post","get"],
				"pdf": ["get","delete"]
			}
	},
};
editor.set(json);
var updatedJson = editor.get();

$('form#permision-form').on('submit', function(e) {
	e.preventDefault();
	data = $(this).serializeArray();
	// var container = document.getElementById("jsoneditor");
	// const updatedJson = container.get();
	console.log(data[1]);
	// setTimeout(function() {
	// 	window.location.href = BASE_URL+'users';
  // }, 1000);
})


