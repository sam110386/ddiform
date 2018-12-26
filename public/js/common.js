$(document).ready(function(){


	

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

	$(document).on("click",".modal-img-view",function(e){
		e.preventDefault();
		$('#form-image-preview').remove();
		var img = $('<img class="img-responsive" id="form-image-preview">');
		img.attr('src', $(this).data('href'));
		img.appendTo('#ModalimageView .modal-body');
		$('#ModalimageView').modal('show');
	});

	$(document).on("click",".form-data",function(e){
		$("#form-data-model .page-loader-wrapper").show();
		data =  JSON.parse(dataList[parseInt($(this).data("modeldata"))]);
		var html='<table class="table table-hover table-bordered table-striped">';


		html = html + "<tr><th>Field</th><th>Value</th></tr>";
		$.each(dataKeys,function(key,field){
			html = html + "<tr><th>"+ dataKeys[key]['label'] +"</th><td>"+ data[key] +"</td></tr>";
		});
			html = html + "<tr><th>Created At</th><td>"+ $(this).data("date") +"</td></tr>";
		html = html + '</table>';
		$("#form-data-model .modal-body .form-data-container").html(html);
		$("#form-data-model .page-loader-wrapper").hide();
	});		
});

$(window).on('load',function(){
	if($(".loader-overley").length) $(".loader-overley").hide();
	if($(".alert-dismissible").length) $('.alert-dismissible').delay(5000).slideUp(1000);
	if($('.dataTable').length) $('.dataTable').DataTable();
})