

$(document).ready(function() {
	var optLokasi = [{ id: 0, text: 'jakarta'},
		{ id: 1, text: 'bogor' },
    { id: 2, text: 'depok' },
    { id: 3, text: 'tangerang' },
    { id: 4, text: 'bekasi' }];
	var parSelect2 = [
		{ input:'#navigasi-akses', data:optLokasi },
	];
	setSelect2(parSelect2);
});

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
