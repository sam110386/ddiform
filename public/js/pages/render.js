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
var callAjax = function (config,callBack){
	$('.loader-overley').show();
	$.ajax(config).done(callBack);
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
	var config = {
		url: $(this).attr('action'),
		method: "post",
		data: $('.email-collection-form').serialize(),
		cache: false,
		// contentType: false,
		// processData: false,
		dataType: 'json',		
	};

	callAjax(config,function(res) {
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
	var formData = new FormData($(this)[0]);
	var data = JSON.stringify($(this).serializeArray());
	formData.append('fd',data);
	var config = {
		url: $(this).attr('action'),
		method: "post",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
	};	
	callAjax(config,function(res) {
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


