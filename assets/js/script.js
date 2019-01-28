jQuery(document).ready(function() {
	$('.date').datetimepicker({
		format: 'LT'
	});
	
	setTimeout(function(){
	    if( $('.alert-dismissible').is(':visible') ) 
	      $(".alert-dismissible").fadeOut(1000);
	},3000);

});
