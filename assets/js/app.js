
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
				$('title').html(ch.label+' - Resume');
				$('#title-breadcrumb').html(ch.label);
				$('#breadcrumb-active').html(ch.label);
			}
		});
	});
	$('ul.navgroup').append(elmNav);

	userLog = loginAs();
	$('#display-user span').html(userLog.nama);
	$('#display-user small').html(userLog.username);
	$('#avatar-pic').attr('src',baseUrl()+'assets/img/'+userLog.avatar);

	$('.modal').on('hide.bs.modal', function() {
		$(this).find('form').trigger('reset');
	});

});

var reloadNavi = function() {
	$('ul.navgroup li').remove();
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
				$('title').html(ch.label+' - Resume');
				$('#title-breadcrumb').html(ch.label);
				$('#breadcrumb-active').html(ch.label);
			}
		});
	});
	$('ul.navgroup').append(elmNav);
}

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
	getLoginas = localStorage.getItem('loginas');
	return JSON.parse(getLoginas);
}

var setAction = function(uri) {
	$.ajax({
		url: BASE_URL+uri,
		type: 'get',
		dataType: 'json',
		success: function(res) {
			$.each(res.data, function(key, val) {
				$('a.action-'+val).remove();
				$('button.action-'+val).remove();
			})
		},
		error: function(err) {
			resAlert(err);
		},
	})
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

var parClass = function() {
	data = Array();
	$.ajax({
		url: baseUrl()+'api/app/select2/class',
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
