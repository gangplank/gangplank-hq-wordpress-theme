$(document).ready(function() {
	$('#primary ul.homepage li:first').addClass('first');
	$('#primary ul.homepage li:first-child div:first-child').addClass('child');
	$('#primary ul.homepage li:first-child ul:first-child').addClass('child');

	$('#primary ul.homepage li:last-child').addClass('last');

	$('#picstrip #dapics a:last').addClass('last');
	$("#homerss ul ul li:last-child").addClass('last');

});
