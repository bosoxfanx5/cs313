
$(document).ready(function() {
	
	$(".aboutme.hidden").fadeIn(2000).removeClass('hidden');

	$(".email").click(function() {
		$(".emailForm").fadeIn(2000).removeClass('hidden');
	
	});
	
	$("#subBtn").click(function() {
		$(".emailForm").addClass('hidden');
		alert("This was my attempt at setting up an email. I hope to learn this technique in class!");
	
	
	});

});