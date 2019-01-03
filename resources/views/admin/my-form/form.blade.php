
<form class="form" method="POST" action="@if($form['form_key'] && Route::current()->getName() == 'admin-single-form'){{ route('save-form',$form['form_key'])}}@else{{route('save-form')}}@endif" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-7">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title text-uppercase">Form details</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-default btn-collapse btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
							<i class="fa fa-chevron-down"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Name <strong class="text-red">*</strong></label>
						<input type="text" class="form-control" id="name" placeholder="Enter form name" value="@if(old('name')){{old('name')}}@else{{ $form['name'] }}@endif" name="name">
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control form-description" placeholder="Enter form description" name="description" id="description">{{ $form['description'] }}</textarea>
					</div>				
					<div class="form-group">
						<label for="success_message">Message on submit</label>
						<input id="success_message" type="text" class="form-control" rows="3" placeholder="Enter thank you message" name="success_message" value="{{ $form['success_message'] }}" />
					</div>
					<div class="form-group">
						<label for="response_text">User response Question</label>
						<input type="text" id="response_text" class="form-control" rows="3" placeholder="User response question" name="response_text" value="{{ $form['response_text'] }}" />
					</div>
					<div class="form-group">
						<label for="submit_text">Submit Button Text</label>
						<input type="text" placeholder="Enter Submit button Text" class="form-control" name="submit_text" id="submit_text" value="{{ $form['submit_text'] }}"/>
					</div>
					<div class="form-group">					
						<label for="image">Upload Banner</label>
						@if($form['image'])
						&nbsp; &nbsp;<a href="javascript:;" data-href="{{$form['image']}}" class="btn btn-info btn-xs img-view" >View</a>
						&nbsp; &nbsp;<a href="javascript:;" class="btn btn-danger btn-xs remove-form-img" >remove</a> 
						@endif
						<input type="hidden" id="form-image-opt" name="form_image_opt" value="yes">
						<input type="file" class="form-control form-image" id="image" name="image" accept="image/*" >
						<small>Maximum 1MB allowed.</small>
					</div>															
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title text-uppercase">Form Controls</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-default btn-collapse btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
							<i class="fa fa-chevron-down"></i>
						</button>
					</div>				
				</div>			
				<div class="box-body">		
					<div class="form-group">
						<label for="columns_each_row">Question(s) each row</label>
						<select class="form-control select2" style="width:100%;" name="columns_each_row" id="columns_each_row">
							<option value="col-md-12" @if($form["columns_each_row"] == "col-md-12") selected="selected" @endif>1</option>
							<option value="col-md-6" @if($form["columns_each_row"] == "col-md-6") selected="selected" @endif >2</option>
							<option value="col-md-4" @if($form["columns_each_row"] == "col-md-4") selected="selected" @endif>3</option>
							<option value="col-md-3" @if($form["columns_each_row"] == "col-md-3") selected="selected" @endif>4</option>
						</select>
					</div>					
					<div class="form-group">
						<label for="image_pos">Banner Position</label>
						<select class="form-control select2" style="width:100%;" id="image_pos" name="image_pos">
							<option value="0" @if($form["image_pos"] == 0) selected="selected" @endif>Before Form</option>
							<option value="1" @if($form["image_pos"] == 1) selected="selected" @endif  >After Form</option>
						</select>
					</div>
					<div class="form-group">
						<input type="checkbox" class="switch" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="email" value="1" @if($form["email"] == 1) checked="checked" @endif>
						<label> &nbsp;Email notification</label>
						<span data-toggle="tooltip" title="" data-original-title="You will notify when anyone submit form"><i class="fa fa-question-circle"></i></span>
					</div>
					<div class="form-group">
						<input type="checkbox" class="switch" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="auto_response" value="1" @if($form["auto_response"] == 0) checked="checked" @endif>
						<label> &nbsp;Do Not Show Results</label>
					</div>
					<div class="form-group">
						<input type="checkbox" class="switch email-collection" data-toggle="toggle"  data-onstyle="success" data-offstyle="danger" name="email_collection" value="1" @if($form["email_collection"] == 1) checked="checked" @endif>
						<label> &nbsp;Email collection</label>
					</div>
					<div class="form-group email_collection_title" @if($form["email_collection"] == 0) style="display:none;" @endif>
						<label for="email_collection_title">Email Collection Title</label>
						<input type="text" placeholder="Email Collection Title" class="form-control" name="email_collection_title" id="email_collection_title" value="{{ $form['email_collection_title'] }}"/>
					</div>
					<div class="form-group">
						<input type="checkbox" class="switch name-collection" name="name_collection" value="1" @if($form["name_collection"] == 1) checked="checked" @endif @if($form["email_collection"] == 0) disabled="disabled" @endif  data-toggle="toggle" data-onstyle="success" data-offstyle="danger">						
						<label>&nbsp;First name<small>(For Email collection)</small></label>
					</div>
					@if($convKitForms)
					<div class="form-group">
						<input type="checkbox" class="switch convert-kit-opt" name="convert_kit_opt" value="1" @if($form["convert_kit_opt"] == 1) checked="checked" @endif  @if($form["email_collection"] == 0) disabled="disabled" @endif data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
						<label> &nbsp; Save Emails on convertKit</label>
					</div>
					<div class="form-group convert_kit_form_id" @if($form["convert_kit_opt"] == 0) style="display:none;" @endif>
						<label for="convert_kit_form_id">Select Convert kit Form</label>
						<select class="form-control" name="convert_kit_form_id" id="convert_kit_form_id">
							<option value="">-- Select Form --</option>
							@foreach($convKitForms as $convKitForm)
							<option value="{{$convKitForm['id']}}" @if($convKitForm['id']==$form['convert_kit_form_id']) selected="seleced" @endif>{{$convKitForm['name']}}</option>
							@endforeach
						</select>
					</div>					
					@endif											
				</div>
			</div>
		</div>
	</div>

	<div class="row form-group">				
		<div class="col-md-7">
			<ul id="accordion" class="field-list ui-sortable">
				@if ($form['fields_arr'])
				@php $fieldTypes= [1=>'Text',2=>'Email',3=>'Phone',4=>'Textarea',5=>'Select/Dropdown',6=>'Radio',7=>'Checkbox',8=>'Image',9=>'File']; @endphp
				@foreach($form['fields_arr'] as $fieldKey => $field)
				<li data-key="{{$fieldKey}}" style="" class="field field_{{$fieldKey}}">
					<div class="box">
						<div class="box-header">
							<span class="handle ui-sortable-handle">
								<i class="fa fa-arrows"></i>
							</span>
							<h3 class="box-title text-uppercase"><span class="text">{{$field['label']}}</span> <small class="label label-default">{{$fieldTypes[$field['fieldType']]}}</small></h3>
							<div class="pull-right box-tools">
								<a class="edit-field btn btn-default btn-collapse btn-sm" data-toggle="collapse" data-parent="#accordion" href="#field_data_{{$fieldKey}}" aria-expanded="false">
									<i class="fa fa-chevron-down"></i>
								</a>
								@if (!$loop->first)
								<a href="javascript:;" class="text-red remove-field btn btn-danger btn-collapse btn-sm"><i class="fa fa-trash-o"></i></a>
								@endif
							</div>
						</div>		
						<div id="field_data_{{$fieldKey}}" class="box-body panel-collapse collapse">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group"> 
										<label for="field_label_{{$fieldKey}}">Question <strong class="text-red">*</strong></label> 
										<input type="text" class="form-control field-label" id="field_label_{{$fieldKey}}" placeholder="Enter question label" name="field_label_['{{$fieldKey}}']" value="{{$field['label']}}" > 
									</div>
								</div>
							</div>
							<div class="row">								
								<div class="col-md-9"> 
									<div class="form-group"> 
										<label for="field_type_{{$fieldKey}}">Question Type</label>
										<select class="form-control select2 field-type" style="width:100%;" name="field_type['{{$fieldKey}}']" id="field_type_{{$fieldKey}}">
											<option value="1" @if($field['fieldType']==1) selected="selected" @endif>Text</option>
											<option value="2" @if($field['fieldType']==2) selected="selected" @endif>Email</option>
											<option value="3" @if($field['fieldType']==3) selected="selected" @endif>Phone</option>
											<option value="4" @if($field['fieldType']==4) selected="selected" @endif>Textarea</option>
											<option value="5" @if($field['fieldType']==5) selected="selected" @endif>Select/Dropdown</option>
											<option value="6" @if($field['fieldType']==6) selected="selected" @endif>Radio</option>
											<option value="7" @if($field['fieldType']==7) selected="selected" @endif>Checkbox</option>
											<option value="8" @if($field['fieldType']==8) selected="selected" @endif>Image</option>
											<option value="9" @if($field['fieldType']==9) selected="selected" @endif>File</option> 
										</select> 
									</div> 
								</div>
								<div class="col-md-3">
									<div class="form-group"> 
										<div class="form-group">
											<label class="col-md-12">&nbsp;</label> 
											<input type="checkbox" class="switch field-required" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="field_required_['{{$fieldKey}}']" value="1" @if($field["required"] == 1) checked="checked" @endif >
											<label> &nbsp;Required</label>
										</div> 
									</div>   
								</div> 
								<div class="clearfix"></div>
								<div class="col-md-12">
									<div class="form-group field_placeholder_container" style="@if($field['fieldType'] > 4 ) display:none @endif"> 
										<label for="field_placeholder_{{$fieldKey}}">Question default value</label>
										<input type="text" class="form-control field-placeholder" name="field_placeholder_['{{$fieldKey}}']" id="field_placeholder_{{$fieldKey}}" placeholder="Question default value (Optional)" value="{{$field['placeholder']}}"> 
									</div>
									<div class="form-group field_values_container " style="@if(in_array($field['fieldType'],[1,2,3,4,8,9])) display:none @endif" > 
										<label for="field_values_{{$fieldKey}}">Options <strong class="text-red">*</strong></label> 
										<?php $options = explode(',',$field['values']); ?>
										@foreach($options as $option)
										<div class="option">
											<input type="text" class="form-control field-values" name="field_values_['{{$fieldKey}}']" id="field_values_{{$fieldKey}}" placeholder="Option" value="{{$option}}">
											@if (!$loop->first)
											<a href="javascript:;" class="text-red remove-option btn btn-danger btn-collapse btn-sm"><i class="fa fa-minus"></i></a>
											@endif
										</div>										
										@endforeach
										<a href="javascript:;" class="add-option btn btn-default btn-collapse btn-sm">
											<i class="fa fa-plus"></i>
										</a>										
									</div> 									
								</div> 
								<div class="clearfix"></div>  
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_before_{{$fieldKey}}">Before Text</label>  
										<input type="text" class="form-control field-before" name="field_before_['{{$fieldKey}}']" id="field_before_{{$fieldKey}}" placeholder="Text before question (Optional)" value="{{$field['before']}}">
									</div>                      
								</div>  
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_after_{{$fieldKey}}">After Text</label>  
										<input id="field_after_{{$fieldKey}}" name="field_after_['{{$fieldKey}}']" class="form-control field-after" placeholder="Text  after question (Optional)" value="{{$field['after']}}">
									</div>                          
								</div>                    
								<div class="clearfix"></div>  
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_image_pos_{{$fieldKey}}">Image Position</label>  
										<select class="form-control select2 field-image-pos" style="width:100%;" id="field_image_pos_{{$fieldKey}}" name="field_image_pos_['{{$fieldKey}}']">  
											<option value="0" @if($field['imagePos'] == 0) selected="selected" @endif >Before Question</option>  
											<option value="1" @if($field['imagePos'] == 1) selected="selected" @endif >After Question</option>  
										</select>  
									</div>  
								</div>    
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_image_{{$fieldKey}}">Question Image</label>
										@if(isset($field['image']) && $field['image'] !="")
										&nbsp; &nbsp;<a data-href="{{$field['image']}}" href="javascript:;" class="btn btn-info btn-xs img-view" >View</a>
										&nbsp; &nbsp;<a href="javascript:;" class="btn btn-xs btn-danger remove-field-img">Remove</a>
										@endif 
										<input type="file" class="form-control field-image" accept="image/*" id="field_image_{{$fieldKey}}" name="field_image_['{{$fieldKey}}']">
										<small>Maximum 1MB allowed.</small>
									</div>  
								</div>  
							</div>  
						</div>

					</div>
				</li> 
				@endforeach
				@else
				<?php $fieldKey = str_slug(str_random(9)); ?>
				<li data-key="{{$fieldKey}}" style="" class="field field_{{$fieldKey}}">
					<div class="box">
						<div class="box-header">
							<span class="handle ui-sortable-handle">
								<i class="fa fa-arrows"></i>
							</span>
							<h3 class="box-title text-uppercase"><span class="text">New Question</span> <small class="label label-default">Text</small></h3>
							<div class="pull-right box-tools">
								<a class="edit-field btn btn-default btn-collapse btn-sm" data-toggle="collapse" data-parent="#accordion" href="#field_data_{{$fieldKey}}" aria-expanded="false">
									<i class="fa fa-chevron-down"></i>
								</a>
							</div>
						</div>		
						<div id="field_data_{{$fieldKey}}" class="box-body panel-collapse collapse in">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group"> 
										<label for="field_label_{{$fieldKey}}">Question <strong class="text-red">*</strong></label> 
										<input type="text" class="form-control field-label" id="field_label_{{$fieldKey}}" placeholder="Enter question" name="field_label_['{{$fieldKey}}']" value="" > 
									</div>
								</div>
							</div>
							<div class="row">								
								<div class="col-md-9"> 
									<div class="form-group"> 
										<label for="field_type_{{$fieldKey}}">Question Type</label>
										<select class="form-control select2 field-type" style="width:100%;" name="field_type['{{$fieldKey}}']" id="field_type_{{$fieldKey}}">
											<option value="1">Text</option>
											<option value="2">Email</option>
											<option value="3">Phone</option>
											<option value="4">Textarea</option>
											<option value="5">Select/Dropdown</option>
											<option value="6">Radio</option>
											<option value="7">Checkbox</option>
											<option value="8">Image</option>
											<option value="9">File</option> 
										</select> 
									</div> 
								</div>
								<div class="col-md-3">
									<div class="form-group"> 
										<div class="form-group">
											<label class="col-md-12">&nbsp;</label> 
											<input type="checkbox" class="switch field-required" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="field_required_['{{$fieldKey}}']" value="1" >
											<label> &nbsp;Required</label>
										</div> 
									</div>   
								</div> 
								<div class="clearfix"></div>
								<div class="col-md-12">
									<div class="form-group field_placeholder_container"> 
										<label for="field_placeholder_{{$fieldKey}}">Question default value</label>
										<input type="text" class="form-control field-placeholder" name="field_placeholder_['{{$fieldKey}}']" id="field_placeholder_{{$fieldKey}}" placeholder="Question default value (Optional)" value=""> 
									</div>
									<div class="form-group field_values_container " style="display:none" > 
										<label for="field_values_{{$fieldKey}}">Options <strong class="text-red">*</strong></label>
										<div class="option">
											<input type="text" class="form-control field-values" name="field_values_['{{$fieldKey}}']" id="field_values_{{$fieldKey}}" placeholder="Option">
										</div>
										<a href="javascript:;" class="add-option btn btn-default btn-collapse btn-sm">
											<i class="fa fa-plus"></i>
										</a>
									</div>                 
								</div> 
								<div class="clearfix"></div>  
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_before_{{$fieldKey}}">Before Text</label>  
										<input type="text" class="form-control field-before" name="field_before_['{{$fieldKey}}']" id="field_before_{{$fieldKey}}" placeholder="Text before Question (Optional)" value="">
									</div>                      
								</div>  
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_after_{{$fieldKey}}">After Text</label>  
										<input id="field_after_{{$fieldKey}}" name="field_after_['{{$fieldKey}}']" class="form-control field-after" placeholder="Text after Question (Optional)" value="">
									</div>                          
								</div>                    
								<div class="clearfix"></div>  
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_image_pos_{{$fieldKey}}"> Image Position</label>  
										<select class="form-control select2 field-image-pos" style="width:100%;" id="field_image_pos_{{$fieldKey}}" name="field_image_pos_['{{$fieldKey}}']">  
											<option value="0">Before Question</option>  
											<option value="1">After Question</option>  
										</select>  
									</div>  
								</div>    
								<div class="col-md-6">  
									<div class="form-group">  
										<label for="field_image_{{$fieldKey}}">Question Image</label>
										<input type="file" class="form-control field-image" accept="image/*" id="field_image_{{$fieldKey}}" name="field_image_['{{$fieldKey}}']"> 
										<small>Maximum 1MB allowed.</small>
									</div>  
								</div>  
							</div>  
						</div>
					</div>
				</li> 				
				@endif
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<input type="hidden" id="fields_json" name="fields_json" value=''>
				<button type="button" class="btn btn-info add-field"><i class="fa fa-plus"></i> Add Question</button> 
				&nbsp; &nbsp; <button type="submit" name="saveform" class="btn bg-blue">Save Form</button>
				@if(Route::current()->getName() == 'single-form')
				&nbsp; &nbsp; <button type="submit" name="saveformtemplate" class="btn btn-primary" value="1">Save Form with Template</button>
				@endif
			</div>
		</div>
	</div>
</form>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalimageView">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<img src="" />
			</div>
		</div>
	</div>
</div>

