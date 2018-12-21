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
	$(document).on("change",".custom-file-input input[type=file]",function(e){
		var file = this.files[0];
		$(this).prev('.custom-file-label-before').html(file.name);
	});
});

$(window).on('load',function(){
	if($(".loader-overley").length) $(".loader-overley").hide();
	if($(".alert-dismissible").length) $('.alert-dismissible').delay(5000).slideUp(1000);
})