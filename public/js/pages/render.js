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
			displayChart();
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
	$('.success-message').remove();
	$('.user-reposnse .chart').html('');
	callAjax(config,function(res) {
		$('.loader-overley').fadeOut();
		if(!res.status) reloadNotification("",res.message);
		var thankYouHtml = "<div class='success-message text-center'><h3>" + res.message + "</h3></div>";
		if(showResponse == 1){
			$('.user-reposnse').prepend(thankYouHtml);
			$('.ddi-form-container').remove();
			$('.user-reposnse').append(
				"<div class='text-center'>" +
				"<p>"+ responseText + "</p>" +
				"<button class='btn btn-info get-response'>View Results</button>" +
				"<p>&nbsp;</p>" +
				"</div>"
				);
			$(".response-container").fadeIn();
		}else{
			$('.ddi-form-container .box-body').html(thankYouHtml);
		}
	});
}

function checkEmailCollection(){
	if(emailCollection == 1){
		$(".response-container").fadeOut();
		$('.email-collection-form-container').fadeIn();
		return;
	}
	displayChart();
}

function displayChart(){
	if(emailCollection == 1 && !emailCollected){
		reloadNotification("","Something went wrong! Please refresh page and try again.");
		return false;
	}
	$('.loader-overley').fadeIn();
	var config = {
		url: $('#response-form').attr('action'),
		method: "post",
		data: $('#response-form').serialize(),
		cache: false,
		dataType: 'json',		
	};
	callAjax(config,function(res) {
		$('.loader-overley').fadeOut();
		if(res.status){
			genarateChart(res.data);
		}else{
			reloadNotification("",res.message);
		}
	});	
}
function genarateChart(chartData){
	barChartData = [];
	if(!$.isEmptyObject(chartData)){
		$.each(chartData,function(key,data){
			chart = '<div class="col-md-10 col-md-offset-1">';
			chart += '<h3>'+ data.label +'</h3>';
			chart += '<div class="single-chart">';
			$.each(data['options'],function(i,val){
				chart += '<div class="progress" data-toggle="tooltip" data-placement="top" title="'+ i +' '+ val +'%">'+
				'<span class="pull-right p-r-10 chart-option">'+ i +'</span>'+
				'<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="'+ val +'" aria-valuemin="0" aria-valuemax="100" style="width: '+ val +'%;background: #'+ getRandomColor() +';">' +
				'<span class="pull-left p-l-10">'+ val +'%</span>' +
				'</div>' + 
				'</div>';
			});
			chart += '</div>';
			chart += '</div>';
			$('.user-reposnse .chart').append(chart);
		})
	}
	$('[data-toggle="tooltip"]').tooltip();
	$(".response-container").fadeIn();

}
$(window).on('load',function(){
	$("#email-collection-form").vf({errorShow: false,onValid: saveEmail});
	$("#ddi-form").vf({errorShow: false,onValid: saveData});
});


