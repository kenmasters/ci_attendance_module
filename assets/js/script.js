jQuery(document).ready(function($) {
	
	const users_api_url = location.protocol + '//' + location.hostname + '/admin/attendance/get_users';

	$('#dtstart, #dtend').datetimepicker({
		format: 'LT'
	});

	$('#minDate, #maxDate').datetimepicker({
		format: 'L'
	});

	$('#timein, #timeout').datetimepicker({
		format: ''
	});

	setTimeout(function(){
	    if( $('.alert-dismissible').is(':visible') ) 
	      $(".alert-dismissible").fadeOut(1000);
	},3000);

	// Change 'form' to class or ID of your specific form
	$(".form").submit(function() {
		$(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
		return true; // ensure form still submits
	});
	
	// Un-disable form fields when page loads, in case they click back after submission
	$( "form" ).find( ":input" ).prop( "disabled", false );

});
