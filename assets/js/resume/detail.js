

let BASE_URL = baseUrl();
var lastPick;
var rand;
$(document).ready(function() {
	// SET RANDOM COLOR IN CARD SKILL
	$('.tag-skills li').each(function() {
		$(this).addClass(randomColor());
	});
});

var randomColor = function() {
	var colors = ['bg-primary','bg-success','bg-info','bg-warning','bg-danger','bg-megna','bg-theme','bg-inverse','bg-purple'];
	var rand = colors[Math.floor(Math.random() * colors.length)];
	rand==lastPick?randomColor():rand;
	lastPick = rand;
	return rand;
}
