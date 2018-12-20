$(document).ready(function(){
	$(document).on('submit','.email-collection-form',function(e){
		e.preventDefault();
		$('.loader-overley').show();
		setTimeout(function(){
			$('.loader-overley').hide();
			$('.form-overlay').hide();
		},2000);
	});
	$(document).on('submit','.ddi-form',function(e){
		e.preventDefault();
		$('.loader-overley').show();
		setTimeout(function(){
			$('.loader-overley').hide();
			$('.ddi-form').hide();
			$('.box-body .other-user-reposnse').append(
				"<div class='text-center'>" +
				"<p>Do you want to see other user’s response?</p>" +
				"<button class='btn btn-info get-response'>Yes</button>" +
				"</div>"
				);
		},2000);
	});

	$(document).on('click','.get-response',function(){
		// $(this).hide();
		// $(this).siblings('p').hide();
		// var donut = new Morris.Donut({
		// 	element: 'response-chart',
		// 	resize: true,
		// 	colors: ["#3c8dbc", "#f56954", "#00a65a"],
		// 	data: [
		// 	{label: "Download Sales", value: 50},
		// 	{label: "In-Store Sales", value: 25},
		// 	{label: "Mail-Order Sales", value: 25}
		// 	],
		// 	hideHover: 'auto'
		// });
	});

});