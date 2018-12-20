$(document).ready(function(){


	if($('.dataTable').length) $('.dataTable').DataTable();

	if($('input[type="checkbox"]').length || $('input[type="radio"]').length){
		$('input[type="checkbox"], input[type="radio"]').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass   : 'iradio_square-blue',
			increaseArea: '20%'
		});
	}

	/*Field shorting */
	if($('.field-list').length){
		$('.field-list').sortable({
			placeholder         : 'sort-highlight',
			handle              : '.handle',
			forcePlaceholderSize: true,
			zIndex              : 999999
		});
	}

});

$(window).on('load',function(){
	if($(".loader-overley").length) $(".loader-overley").hide();
	if($(".alert-dismissible").length) $('.alert-dismissible').delay(5000).slideUp(1000);
})