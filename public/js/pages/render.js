var emailCollected = false;
$(document).ready(function(){
	$(document).on('click','.get-response',function(){		
		$(this).fadeOut();
		$(this).siblings('p').fadeOut();
		checkEmailCollection();
	});

});

// Common AJAX Method
var callAjax = function (config,callBack){
	$('.loader-overley').fadeIn();
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
		dataType: 'json',		
	};
	callAjax(config,function(res) {
		$('.loader-overley').fadeOut();
		if(res.status){
			emailCollected = true;
			$(".email-collection-form-container").fadeOut();
			showResponse();
		}else{
			reloadNotification("",res.message);
		}
	});
}


// save form data
var saveData =  function(){
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
	$('.user-reposnse').html('');
	callAjax(config,function(res) {
		$('.loader-overley').fadeOut();
		if(!res.status) reloadNotification("",res.message);
		$('.ddi-form-container').fadeOut();
		$('.user-reposnse').append("<div class='success-message'><h3>" + res.message + "</h3></div>");
		if(autoResponse == 1){
			checkEmailCollection();
			return;
		}
		$('.user-reposnse').append(
			"<div class='text-center'>" +
			"<p>Do you want to see other user’s response?</p>" +
			"<button class='btn btn-info get-response'>Yes</button>" +
			"<p>&nbsp;</p>" +
			"</div>"
			);
		$(".response-container").fadeIn();
	});
}

function checkEmailCollection(){
	if(emailCollection == 1){
		$(".response-container").fadeOut();
		$('.email-collection-form-container').fadeIn();
		return;
	}
	showResponse();
}

function showResponse(){
	if(emailCollection == 1 && !emailCollected){
		reloadNotification("","Something went wrong! Please refresh page and try again.");
		return false;
	}
	$('.loader-overley').fadeIn();
	$('.user-reposnse').append('<div class="chart" id="response-chart" style="height: 300px; position: relative;">user responses</div>');
	$(".response-container").fadeIn();
	$('.loader-overley').fadeOut();
}

$(window).on('load',function(){
	$("#email-collection-form").vf({errorShow: false,onValid: saveEmail});
	$("#ddi-form").vf({errorShow: false,onValid: saveData});
});


