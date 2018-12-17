$(document).ready(function(){
	function randomString(length) {
		return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
	}	
	$('.add-field').click(function(){
		var fieldKey = randomString(9);
		var fieldHtlm =  '              <li data-key="'+ fieldKey +'" style="" class="field panel field_'+ fieldKey +'">  '  + 
		'                <span class="handle ui-sortable-handle">  '  + 
		'                  <i class="fa fa-arrows"></i>  '  + 
		'                </span>  '  + 
		'                <span class="text">Field1</span>  '  + 
		'                <small class="label label-default">2 mins</small>  '  + 
		'                <div class="tools">  '  + 
		'                  <a data-toggle="collapse" data-parent="#accordion" href="#field_data_'+ fieldKey +'" aria-expanded="false">  '  + 
		'                    <i class="fa fa-edit"></i>   '  + 
		'                  </a>  '  + 
		'                  <i class="fa fa-trash-o"></i>  '  + 
		'                </div>  '  + 
		'                <div id="field_data_'+ fieldKey +'" class="panel-collapse collapse">  '  + 
		'                  <div class="row">  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_type_'+ fieldKey +'">Field Type</label>  '  + 
		'                        <select class="form-control select2 field-type" style="width:100%;" name="field_type[\''+ fieldKey +'\']" id="field_type_'+ fieldKey +'">  '  + 
		'                          <option value="1" selected="selected">Text</option>  '  + 
		'                          <option value="2">Email</option>  '  + 
		'                          <option value="3">Phone</option>  '  + 
		'                          <option value="4">Textarea</option>  '  + 
		'                          <option value="5">Select/Dropdown</option>  '  + 
		'                          <option value="6">Radio</option>  '  + 
		'                          <option value="7">Checkbox</option>  '  + 
		'                          <option value="8">Image</option>  '  + 
		'                          <option value="9">File</option>  '  + 
		'                        </select>  '  + 
		'                      </div>                      '  + 
		'                    </div>  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_label_'+ fieldKey +'">Label <strong class="text-red">*</strong></label>  '  + 
		'                        <input type="text" class="form-control field-label" id="field_label_'+ fieldKey +'" placeholder="Enter field label" name="field_label[\''+ fieldKey +'\']"  >  '  + 
		'                      </div>  '  + 
		'                    </div>  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <div class="form-group">  '  + 
		'                          <label class="col-md-12">&nbsp;</label>  '  + 
		'                          <label><input type="checkbox" class="minimal field-required" name="field_required[\''+ fieldKey +'\']" value="1"> &nbsp;Required</label>  '  + 
		'                        </div>    '  + 
		'                      </div>                      '  + 
		'                    </div>  '  + 
		'                    <div class="clearfix"></div>  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_id_'+ fieldKey +'">Id </label>  '  + 
		'                        <input type="text" class="form-control field-id" id="field_id_'+ fieldKey +'" placeholder="Field ID (Optional)" name="field_id_[\''+ fieldKey +'\']">  '  + 
		'                      </div>  '  + 
		'                    </div>  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_class_'+ fieldKey +'">Class</label>  '  + 
		'                        <input type="text" class="form-control field-class" name="field_class_[\''+ fieldKey +'\']" id="field_class_'+ fieldKey +'" placeholder="Field Class (Optional)">  '  + 
		'                      </div>  '  + 
		'                    </div>  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group field_placeholder_container">  '  + 
		'                        <label for="field_placeholder_'+ fieldKey +'">Placeholder</label>  '  + 
		'                        <input type="text" class="form-control field-placeholder" name="field_placeholder_[\''+ fieldKey +'\']" id="field_placeholder_'+ fieldKey +'" placeholder="Field Placeholder (Optional)">  '  + 
		'                      </div>  '  + 
		'                      <div class="form-group field_values_container" >  '  + 
		'                        <label for="field_values_'+ fieldKey +'">Values <strong class="text-red">*</strong></label>  '  + 
		'                        <input type="text" class="form-control field-values" name="field_values_[\''+ fieldKey +'\']" id="field_values_'+ fieldKey +'" placeholder="Field values (Comma seprated. eg. value one,value two,value three)">  '  + 
		'                      </div>                      '  + 
		'                    </div>  '  + 
		'                    <div class="clearfix"></div>  '  + 
		'                    <div class="col-md-6">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_before_'+ fieldKey +'">Before Text</label>  '  + 
		'                        <textarea class="form-control field-before" name="field_before_[\''+ fieldKey +'\']" id="field_before_'+ fieldKey +'" placeholder="Text/Tag before Field (Optional)"></textarea>  '  + 
		'                      </div>                      '  + 
		'                    </div>  '  + 
		'                    <div class="col-md-6">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_after_'+ fieldKey +'">After Text</label>  '  + 
		'                        <textarea id="field_after_'+ fieldKey +'" name="field_after_[\''+ fieldKey +'\']" class="form-control field-after" placeholder="Text/Tag after Field (Optional)"></textarea>  '  + 
		'                      </div>                          '  + 
		'                    </div>                    '  + 
		'                    <div class="clearfix"></div>  '  + 
		'                    <div class="col-md-4">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_image_pos_'+ fieldKey +'">Field Image Position</label>  '  + 
		'                        <select class="form-control select2 field-image-pos" style="width:100%;" id="field_image_pos_'+ fieldKey +'" name="field_image_pos_[\''+ fieldKey +'\']">  '  + 
		'                          <option value="0" selected="selected">Before Form</option>  '  + 
		'                          <option value="1" >After Form</option>  '  + 
		'                        </select>  '  + 
		'                      </div>  '  + 
		'                    </div>    '  + 
		'                    <div class="col-md-8">  '  + 
		'                      <div class="form-group">  '  + 
		'                        <label for="field_image_'+ fieldKey +'">Field Image</label>  '  + 
		'                        <input type="file" class="form-control form-image" id="field_image_'+ fieldKey +'" name="field_image_[\''+ fieldKey +'\']">  '  + 
		'                      </div>  '  + 
		'                    </div>  '  + 
		'                  </div>  '  + 
		'                </div>'  + 
		'              </li>   ' ;
		$("ul#accordion").append(fieldHtlm);
		$("ul#accordion li.field_"+fieldKey+ " a").trigger('click');
	});

	// detect field type
	$(document).on("change",".field-type", function(){
		$this = $(this);
		val = $this.val();
		text = $("option:selected", $this)
		text = text[0].innerHTML;
		console.log(text);
		$this.parents("li.field small.label.label-default").html(text);
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


	$('.form').on('submit',function(){
		var error = false;
		$("*").removeClass('has-error');
		if($("#name").val() == ""){
			$("#name").parent('.form-group').addClass("has-error");
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
			fieldClass = fld.find('.field-class').val();
			fieldId = fld.find('.field-id').val();
			fieldValues =fld.find('.field-values').val();
			fieldPlaceholder = fld.find('.field-placeholder').val();              
			fieldBefore = fld.find('.field-before').val();
			fieldAfter = fld.find('.field-after').val();
			fieldImagePos = fld.find('.field-image-pos').val();

			fields[fieldKey] = {fieldType: fieldType ,
				label: fieldLabel,
				required: fieldRequired,
				fclass: fieldClass,
				id: fieldId,
				values: fieldValues,
				placeholder: fieldPlaceholder,
				before: fieldBefore,
				after: fieldAfter,
				imagePos: fieldImagePos
			};
		});
		var field_json = '';
		for (var i in fields){
			console.log(fields[i]);
			field_json = field_json + i + ": " + JSON.stringify(fields[i]) + ",";
		}
		console.log(field_json);
		$('#fields_json').val("["+ field_json.replace(/(^,)|(,$)/g, "") + "]");
		if(error){
			return false;
		}else{
			return true;
		}
	});
});


$(window).on('load',function(){
});