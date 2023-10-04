

let BASE_URL = baseUrl();
var lastPick;
var rand;
$(document).ready(function() {
	// SET RANDOM COLOR IN CARD SKILL
	$('.tag-skills li').each(function() {
		$(this).addClass(randomColor());
	});

	// CONFIG SLIMCSCROLL MODAL
	$('#modal-experience .modal-body, #modal-education .modal-body, #modal-skills .modal-body .scroll-skills').slimScroll({
		height: '100%',
		size: '5px',
		distance: '2px',
		wheelStep: 13,
	});
	
	// MODIFY SLIMSCROLL IN MODAL
	var state = {
		pos: { lowest: 0, current: 0 },
		offset: { top: [0, 0]}
	}
	$('#modal-experience .modal-body').slimScroll().bind('slimscrolling', function (e, pos) {
		state.pos.highest = pos !== state.pos.highest ?
				pos > state.pos.highest ? pos : state.pos.highest
			: state.pos.highest;
			
		state.offset.top.push(pos - state.pos.lowest);
		state.offset.top.shift();
	
		if(state.offset.top[0] === 0) {
			$('#modal-experience .modal-header').removeAttr('style');
			$('#modal-experience .modal-footer').css('box-shadow', '0 5px 20px 0 rgba(0,0,0,0.15)');
		} else {
			$('#modal-experience .modal-header').css('box-shadow', '0 5px 20px 0 rgba(0,0,0,0.15)');
		}
	
		if(state.offset.top[0] >= 110) {
			$('#modal-experience .modal-footer').removeAttr('style');
		} else {
			$('#modal-experience .modal-footer').css('box-shadow', '0 5px 20px 0 rgba(0,0,0,0.15)');
		}
	})
	$('#modal-education .modal-body').slimScroll().bind('slimscrolling', function (e, pos) {
		state.pos.highest = pos !== state.pos.highest ?
				pos > state.pos.highest ? pos : state.pos.highest
			: state.pos.highest;
			
		state.offset.top.push(pos - state.pos.lowest);
		state.offset.top.shift();
	
		if(state.offset.top[0] === 0) {
			$('#modal-education .modal-header').removeAttr('style');
			$('#modal-education .modal-footer').css('box-shadow', '0 5px 20px 0 rgba(0,0,0,0.15)');
		} else {
			$('#modal-education .modal-header').css('box-shadow', '0 5px 20px 0 rgba(0,0,0,0.15)');
		}
	
		if(state.offset.top[0] >= 100) {
			$('#modal-education .modal-footer').removeAttr('style');
		} else {
			$('#modal-education .modal-footer').css('box-shadow', '0 5px 20px 0 rgba(0,0,0,0.15)');
		}
	})

	// SET MAX INPUT MONTH
	let now = new Date();
	let plus = new Date(now);
	// plus.setMonth(plus.getMonth() + 1);
	string = plus.toISOString().split('T')[0].split('-');
	max = `${string[0]}-${string[1]}`;
	$('input#tgl_mulai').attr('max', max);
	$('input#tgl_berakhir').attr('max', max);

	// SET SELECT2
	var optLokasi = [{ id: 0, text: 'jakarta'},
		{ id: 1, text: 'bogor' },
    { id: 2, text: 'depok' },
    { id: 3, text: 'tangerang' },
    { id: 4, text: 'bekasi' }];
	var optTypeWork = [
		{ id: 0, text: 'Freelance'},
		{ id: 1, text: 'Fulltime' }
	];
	var parSelect2 = [
		{ input:'#lokasi-perusahaan, #lokasi-sekolah', data:optLokasi },
		{ input:'#jenis-pekerjaan, #degree', data:optTypeWork },
	];
	setSelect2(parSelect2);
	setTags();
});

var setTags = function() {
	var tags = ['api','html','java','php','css','mysql'];
	$("#input-tags").select2({
		multiple: true,
    tags: true,
    data: tags,
		maximumSelectionLength: 20,
    tokenSeparators: ['/n'],
		dropdownParent: $('#modal-skills')
	}).on('select2:open', function(e) {
		$('.select2-container--open .select2-dropdown--below').css('display','none');
	}).on('select2:select', function(event) {
		if(event.currentTarget.length >= 20) {
			alertMsg('Too many skills');
		}
	});
	$('#input-tags').val(tags).trigger('change');
}

$('#modal-skills').on('hidden.bs.modal', function() {
	setTags();
})


var randomColor = function() {
	var colors = ['bg-primary','bg-success','bg-info','bg-warning','bg-danger','bg-megna','bg-theme','bg-inverse','bg-purple'];
	var rand = colors[Math.floor(Math.random() * colors.length)];
	rand==lastPick?randomColor():rand;
	lastPick = rand;
	return rand;
}

// GET TAB TEXT FOR TARGET MODAL
$('ul#profile-tab li a').on('click', function() {
	text = $(this).text().toLowerCase();
	$('#btn-add').attr('data-target', '#modal-'+text);
	url = baseUrl()+'profile/'+text;
	$('#btn-edit').attr('href', url);
})

// SET HIDDEN WHEN CURRENT WORK
$('input#masih_bekerja, input#masih_sekolah').on('change', function() {
	checked = $(this).is(':checked');
	if(checked == true) {
		$('#end-at input').attr('disabled', true);
		$('#end-at').hide();
	} else {
		$('#end-at input').removeAttr('disabled', true);
		$('#end-at').show();
	}
})
$('input#masih_sekolah').on('change', function() {
	checked = $(this).is(':checked');
	if(checked == true) {
		$('#end-school input').attr('disabled', true);
		$('#end-school').hide();
	} else {
		$('#end-school input').removeAttr('disabled', true);
		$('#end-school').show();
	}
})


// FORM SUBMITED
$('form#add-experience').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Add Experience Success');
	setTimeout(function() {
    $('#modal-experience').modal('hide'); 
  }, 1000);
})

$('form#add-education').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Add Education Success');
	setTimeout(function() {
    $('#modal-education').modal('hide'); 
  }, 1000);
})

$('form#modify-skill li a').on('click', function() {
	parent = this.parentNode;
	$(parent).remove();
})

$('form#modify-skill').on('submit', function(e) {
	e.preventDefault();
	alertMsg('Modify Skills Success');
	setTimeout(function() {
    $('#modal-skills').modal('hide'); 
  }, 1000);
})

var del = function() {
	confirmMsg();
}






