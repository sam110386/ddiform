$(document).ready(function(){
	$('.alert-dismissible').delay(5000).slideUp(1000);
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
})