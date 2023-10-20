
$(document).ready(function() {
	dtNav = dataNavigasi();
	elmNav = '';
	$.each(dtNav, function(key, val) {
		elmNav += '<li class="nav-devider"></li>';
		elmNav += '<li class="nav-label">'+key.toUpperCase()+'</li>';

		$.each(val, function(q, ch) {
			aktif = (ch.nama == navAktif) ? 'aktif' : '';
			elmNav += '<li class="navmenu '+aktif+'" id="'+ch.nama+'">'+
				'<a href="'+baseUrl()+ch.url+'">'+
					'<i class="'+ch.icon+'"></i>'+
					'<span class="hide-menu">'+ch.label+'</span>'+
				'</a>'+
			'</li>';	

			if(ch.nama == navAktif) {
				bread = '<a href="javascript:void(0)">'+key+'</a>';
				$('#breadcrumb-nav').html(bread);
			}
		});
	});
	$('ul.navgroup').append(elmNav);

	userLog = loginAs();
	$('#display-user span').html(userLog.nama);
	$('#display-user small').html(userLog.username);
	$('#avatar-pic').attr('src',baseUrl()+'assets/img/'+userLog.avatar);
});

var dataNavigasi = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/navigasi',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}

var loginAs = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/loginas',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}

var parNav = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/select2/nav',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}

var parFunc = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/select2/func',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}

var parMethod = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/select2/method',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}

var parAksi = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/select2/aksi',
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}

var parChild = function(parent) {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/select2/is_child/'+parent,
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(res) {
			data = res.data;
		}
	})
	return data;
}
