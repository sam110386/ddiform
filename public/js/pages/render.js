var emailCollected = false;
$(document).ready(function(){
	$(document).on('click','.get-response',function(){
		$(this).hide();
		$(this).siblings('p').hide();
		showResponse();
	});

});

function showResponse(){
	$('.other-user-reposnse').append('<div class="chart" id="response-chart" style="height: 300px; position: relative;">user responses</div>');
}
// Common AJAX Method
var callAjax = function (url,data,callBack){
	$('.loader-overley').show();
	$.ajax({
		url: url,
		method: "post",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',		
	}).done(callBack);
}

var reloadNotification = function(title,message){
	swal({
		title: title,
		text: message,
		type: "error",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Reload form",
		closeOnConfirm: true
	},
	function(confirm){
		if (confirm) location.reload();
	});
}


// Save Email Collection
var saveEmail = function(){
	callAjax(
		$(this).attr('action'),
		$('.email-collection-form').serialize(),
		function(res) {
			$('.loader-overley').hide();
			if(res.status){
				emailCollected = true;
				$('.form-overlay').hide();
				$('.ddi-form-container').show();
			}else{
				reloadNotification("",res.message);
			}
		});
}


// save form data
var saveData =  function(){
	if(emailCollection == 1 && !emailCollected){
		reloadNotification("","Something went wrong! Please refresh page and try again.");
		return false;
	}	
	var data = new FormData();
	$.each($('#ddi-form input[type=file].custom-file-input'), function(i, file) {
		fileData = file.files[0];
		data.append(file.name, fileData);
	});
	var formData = JSON.stringify($(this).serializeArray());
	data.append('fd',formData);
	data.append('_token',$('#ddi-form input[name=_token]').val()); 
	callAjax(
		$(this).attr('action'),
		data,
		function(res) {
			$('.loader-overley').hide();
			if(!res.status) reloadNotification("",res.message);
			$('#ddi-form').hide();
			if(autoResponse == 1 ){
				showResponse();
				return;
			}
			$('#ddi-form').after(
				"<div class='text-center'>" +
				"<p>Do you want to see other user’s response?</p>" +
				"<button class='btn btn-info get-response'>Yes</button>" +
				"</div>"
				);
		});
}

$(window).on('load',function(){
	$("#email-collection-form").vf({errorShow: false,onValid: saveEmail});
	$("#ddi-form").vf({errorShow: false,onValid: saveData});
});


