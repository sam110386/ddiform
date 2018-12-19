$(document).ready(function(){
	$('.dataTable').DataTable();

	$('.alert-dismissible').delay(5000).slideUp(1000);
	
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
	});

	/*Field shorting */
	$('.field-list').sortable({
		placeholder         : 'sort-highlight',
		handle              : '.handle',
		forcePlaceholderSize: true,
		zIndex              : 999999
	});

})