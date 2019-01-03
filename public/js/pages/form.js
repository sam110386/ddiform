$(document).ready(function(){
	function randomString(length) {
		return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
	}	
	$('.add-field').click(function(){
		var fieldKey = randomString(9);
		var fieldHtlm =				'<li data-key="'+ fieldKey +'" style="" class="field field_'+ fieldKey +'"> ' +
		' 	<div class="box">'+
		' 		<div class="box-header">'+
		' 			<span class="handle ui-sortable-handle">'+
		' 				<i class="fa fa-arrows"></i>'+
		' 			</span>'+
		' 			<h3 class="box-title text-uppercase"><span class="text">New Question</span> <small class="label label-default">Text</small></h3>'+
		' 			<div class="pull-right box-tools">'+
		' 				<a class="edit-field btn btn-default btn-collapse btn-sm" data-toggle="collapse" data-parent="#accordion" href="#field_data_'+ fieldKey +'" aria-expanded="false">'+
		' 					<i class="fa fa-chevron-down"></i>'+
		' 				</a>'+
		' 				<a href="javascript:;" class="text-red remove-field btn btn-danger btn-collapse btn-sm"><i class="fa fa-trash-o"></i></a>'+
		' 			</div>'+
		' 		</div>'+
		' 		<div id="field_data_'+ fieldKey +'" class="box-body panel-collapse collapse">'+
		' 			<div class="row">'+
		' 				<div class="col-md-12">'+
		' 					<div class="form-group"> '+
		' 						<label for="field_label_'+ fieldKey +'">Question <strong class="text-red">*</strong></label> '+
		' 						<input type="text" class="form-control field-label" id="field_label_'+ fieldKey +'" placeholder="Enter question" name="field_label_['+ fieldKey +']" value="" > '+
		' 					</div>'+
		' 				</div>'+
		' 			</div>'+
		' 			<div class="row">'+
		' 				<div class="col-md-9"> '+
		' 					<div class="form-group"> '+
		' 						<label for="field_type_'+ fieldKey +'">Question Type</label>'+
		' 						<select class="form-control select2 field-type" style="width:100%;" name="field_type['+ fieldKey +']" id="field_type_'+ fieldKey +'">'+
		' 							<option value="1">Text</option>'+
		' 							<option value="2">Email</option>'+
		' 							<option value="3">Phone</option>'+
		' 							<option value="4">Textarea</option>'+
		' 							<option value="5">Select/Dropdown</option>'+
		' 							<option value="6">Radio</option>'+
		' 							<option value="7">Checkbox</option>'+
		' 							<option value="8">Image</option>'+
		' 							<option value="9">File</option> '+
		' 						</select> '+
		' 					</div> '+
		' 				</div>'+
		' 				<div class="col-md-3">'+
		' 					<div class="form-group"> '+
		' 						<div class="form-group">'+
		' 							<label class="col-md-12">&nbsp;</label> '+
		' 							<input type="checkbox" class="switch field-required" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="field_required_['+ fieldKey +']" value="1" >'+
		' 							<label> &nbsp;Required</label>'+
		' 						</div>'+ 
		' 					</div>   '+
		' 				</div> '+
		' 				<div class="clearfix"></div>'+
		' 				<div class="col-md-12">'+
		' 					<div class="form-group field_placeholder_container"> '+
		' 						<label for="field_placeholder_'+ fieldKey +'">Question default value</label>'+
		' 						<input type="text" class="form-control field-placeholder" name="field_placeholder_['+ fieldKey +']" id="field_placeholder_'+ fieldKey +'" placeholder="Question Placeholder (Optional)" value=""> '+
		' 					</div>'+
		'<div class="form-group field_values_container " style="display:none" > ' + 
		'	<label for="field_values_'+ fieldKey +'">Options <strong class="text-red">*</strong></label>' + 
		'	<div class="option">' + 
		'		<input type="text" class="form-control field-values" name="field_values_['+ fieldKey +']" id="field_values_{{$fieldKey}}" placeholder="Option">' + 
		'	</div>' + 
		'	<a href="javascript:;" class="add-option btn btn-default btn-collapse btn-sm">' + 
		'		<i class="fa fa-plus"></i>' + 
		'	</a>' + 
		'</div>' + 
		' 				</div> '+
		' 				<div class="clearfix"></div>  '+
		' 				<div class="col-md-6">  '+
		' 					<div class="form-group">  '+
		' 						<label for="field_before_'+ fieldKey +'">Before Text</label>  '+
		' 						<input type="text" class="form-control field-before" name="field_before_['+ fieldKey +']" id="field_before_'+ fieldKey +'" placeholder="Text/Tag before Field (Optional)" value="">'+
		' 					</div>'+
		' 				</div>  '+
		' 				<div class="col-md-6">  '+
		' 					<div class="form-group">  '+
		' 						<label for="field_after_'+ fieldKey +'">After Text</label>  '+
		' 						<input id="field_after_'+ fieldKey +'" name="field_after_['+ fieldKey +']" class="form-control field-after" placeholder="Text/Tag after Field (Optional)" value="">'+
		' 					</div>'+
		' 				</div>'+
		' 				<div class="clearfix"></div>  '+
		' 				<div class="col-md-6">  '+
		' 					<div class="form-group">  '+
		' 						<label for="field_image_pos_'+ fieldKey +'">Question Image Position</label>  '+
		' 						<select class="form-control select2 field-image-pos" style="width:100%;" id="field_image_pos_'+ fieldKey +'" name="field_image_pos_['+ fieldKey +']">  '+
		' 							<option value="0">Before Form</option>  '+
		' 							<option value="1">After Form</option>  '+
		' 						</select>'+  
		' 					</div> '+ 
		' 				</div>    '+
		' 				<div class="col-md-6">  '+
		' 					<div class="form-group">  '+
		' 						<label for="field_image_'+ fieldKey +'">Question Image</label>'+
		' 						<input type="file" class="form-control field-image" accept="image/*" id="field_image_'+ fieldKey +'" name="field_image_['+ fieldKey +']"> '+
		' 						<small>Maximum 1MB allowed.</small>'+
		' 					</div>  '+
		' 				</div>  '+
		' 			</div>  '+
		' 		</div>'+
		' 	</div>' +
		' </li> ';		
		$("ul#accordion").append(fieldHtlm);
		$('.switch').bootstrapToggle();
		$("ul#accordion li.field_"+fieldKey+ " a.edit-field").trigger('click');
	});


$(document).on('click','.add-option',function(){
	$(this).prev(".option").clone().insertBefore(this);
	$(this).prev(".option").children('input').val('');
	var remBtn = '<a href="javascript:;" class="text-red remove-option btn btn-danger btn-collapse btn-sm"><i class="fa fa-minus"></i></a>';
	$(this).prev(".option").append(remBtn);
});

$(document).on('click','.remove-option',function(){
	$(this).parent(".option").remove();
});

	// Detect field type
	$(document).on("change",".field-type", function(){
		$this = $(this);
		val = $this.val();
		text = $("option:selected", $this)
		text = text[0].innerHTML;
		$this.parents("li.field").find('small.label.label-default').html(text);
		if(val > 4 && val < 8 ){
			$this.parents("li.field").find('.field_values_container').show();
			$this.parents("li.field").find('.field_placeholder_container').hide();
		}else if(val < 5 && val > 0){
			$this.parents("li.field").find('.field_values_container').hide();
			$this.parents("li.field").find('.field_placeholder_container').show();
		}else if(val > 7){
			$this.parents("li.field").find('.field_values_container').hide();
			$this.parents("li.field").find('.field_placeholder_container').hide();      
		}
	});


	$(document).on("change",".email-collection",function(e){
		var chckValue = $(this).prop('checked');
		if(!chckValue){
			$('.name-collection').bootstrapToggle('off');
			$('.name-collection').bootstrapToggle('disable');
			$(".convert-kit-opt").bootstrapToggle('off');
			$(".convert-kit-opt").bootstrapToggle('disable');

			$('.email_collection_title input').val('');
			$('.convert_kit_form_id select option').removeAttr('selected');
			$('.email_collection_title,.convert_kit_form_id').slideUp();
		}else{
			$('.name-collection').bootstrapToggle('enable');
			$(".convert-kit-opt").bootstrapToggle('enable');
			$('.email_collection_title').slideDown();
		}
	});

	$(document).on("change",".convert-kit-opt",function(e){
		var chckValue = $(this).prop('checked');
		if(chckValue){
			$('.convert_kit_form_id').slideDown();
		}else{
			$('.convert_kit_form_id select option').removeAttr('selected');
			$('.convert_kit_form_id').slideUp();			
		}
	});


	$(document).on("click",".remove-field-img",function(e){
		$(this).siblings('a').data('href','').hide();
		$(this).remove();
	});
	$(document).on("click",".img-view",function(e){
		$('#form-image-preview').remove();
		var img = $('<img class="img-responsive" id="form-image-preview">');
		img.attr('src', $(this).data('href'));
		img.appendTo('#ModalimageView .modal-body');
		$('#ModalimageView').modal('show');
	});

	$(document).on("click",".remove-form-img",function(e){
		$("#form-image-opt").val('no');
		$(this).siblings('a').remove();
		$(this).remove();
	});

	$(document).on("keyup",".field-label",function(e){
		label = ($(this).val()) ? $(this).val(): "Field Name" ;
		$(this).parents(".field.panel").children('.text').html( label );
	});
	
	$(document).on("change",".form-image,.field-image ",function(e){
		var file = this.files[0];
		if(file.size > 1048576){
			swal("", "The maximum file-size limit is 1MB", "error");
			$(this).val('');
		}else{
			$("#form-image-opt").val('yes');
		}

	});


	$(document).on("click",".remove-field",function(e){
		var field = $(this).parents('li.field');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this field!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true,
		},
		function(isConfirm) {
			if (isConfirm){
				field.remove();
				swal({title: "",text:"Field deleted!", type:"success",timer: 1500});
			}
		});
	});

	$(document).on('submit','.remove-form',function(e){
		e.preventDefault();
		var form = $(this).attr('id');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this form!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm) {
			if (isConfirm) $("#"+form)[0].submit();
		});
	});

	$('.form').on('submit',function(){
		var error = false;
		$("*").removeClass('has-error');
		if($("#name").val() == ""){
			$("#name").parent('.form-group').addClass("has-error");
			error =  true;
		}

		if($("#submit_text").val() == "" || $.trim($("#submit_text").val()) == ""){
			$("#submit_text").parent('.form-group').addClass("has-error");
			error =  true;
		}
		var chckValue = $('.convert-kit-opt').iCheck('update')[0].checked;
		if(chckValue && $("#convert_kit_form_id").val() == ""){
			$("#convert_kit_form_id").parent('.form-group').addClass("has-error");
			error =  true;
		}
		$('#fields_json').val('');
		$("li.field").removeClass('field-error');
		var fields = [];
		$("li.field").each(function(){
			fld = $(this);
			fieldKey = fld.data('key');
			fieldType =fld.find('.field-type :selected').val();
			fieldLabel = fld.find('.field-label').val();
			if(!fieldLabel){
				fld.find('.field-label').parent('.form-group').addClass("has-error");
				$("li.field_" + fieldKey).addClass('field-error');
				$("ul#accordion li.field_"+fieldKey+ " a.collapsed").trigger('click');
				error = true;
			}

			fieldRequired = (fld.find('.field-required').is(":checked")) ? true : false ;
			fieldValues = (fld.find('.field-values').val()) ? $.trim(fld.find('.field-values').val()) : false;
			
			if($.inArray(fieldType,["5","6","7"]) >= 0 && !fieldValues){
				fld.find('.field-values').parents('.field_values_container').addClass("has-error");
				$("li.field_" + fieldKey).addClass('field-error');
				$("ul#accordion li.field_"+fieldKey+ " a.collapsed").trigger('click');
				error = true;
			}
			var options = [];
			fld.find('.field-values').each(function(i,option){
				options.push(option.value);
			});
			fieldValues = options.join(', ');

			fieldPlaceholder = fld.find('.field-placeholder').val();              
			fieldBefore = fld.find('.field-before').val();
			fieldAfter = fld.find('.field-after').val();
			fieldImagePos = fld.find('.field-image-pos').val();
			fieldImage = fld.find('.img-view').data("href");
			fields[fieldKey] = {fieldType: fieldType ,
				label: fieldLabel,
				required: fieldRequired,
				values: fieldValues,
				placeholder: fieldPlaceholder,
				before: fieldBefore,
				after: fieldAfter,
				imagePos: fieldImagePos,
				image: fieldImage
			};
		});
		var field_json = '';
		for (var i in fields){
			console.log(fields[i]);
			field_json = field_json + '"' + i + '": ' + JSON.stringify(fields[i]) + ',';
		}

		$('#fields_json').val("{"+ field_json.replace(/(^,)|(,$)/g, "") + "}");
		if(error){
			return false;
		}else{
			return true;
		}
	});
});


$(window).on('load',function(){
	$('.switch').bootstrapToggle();
});