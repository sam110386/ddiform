@extends('layouts.app')
@push('scripts')
<script type="text/javascript" src="{{ asset('js/pages/form.js') }}"></script>
@endpush
@section('content')
<div class="box">
	<div class="box-body">
		<form class="form" method="POST" action="@if($form['form_key'] && Route::current()->getName() == 'single-form'){{ route('save-form',$form['form_key'])}}@else{{route('save-form')}}@endif" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Name <strong class="text-red">*</strong></label>
						<input type="text" class="form-control" id="name" placeholder="Enter form name" value="@if(old('name')){{old('name')}}@else{{ $form['name'] }}@endif" name="name">
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" rows="3" placeholder="Enter form description" name="description">{{ $form['description'] }}</textarea>
					</div>	
				</div>
				<div class="col-md-6">	
					<div class="form-group">
						<label>Message on submit</label>
						<textarea class="form-control" rows="3" placeholder="Enter form description" name="success_message">{{ $form['success_message'] }}</textarea>
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="image_pos">Image Position</label>
						<select class="form-control select2" style="width:100%;" id="image_pos" name="image_pos">
							<option value="0" @if($form["image_pos"] == 0) selected="selected" @endif>Before Form</option>
							<option value="1" @if($form["image_pos"] == 1) selected="selected" @endif  >After Form</option>
						</select>
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">					
						<label for="image">Upload Image </label>
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
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="columns_each_row">Columns each row</label>
						<select class="form-control select2" style="width:100%;" name="columns_each_row" id="columns_each_row">
							<option value="col-md-12" @if($form["columns_each_row"] == "col-md-12") selected="selected" @endif>1</option>
							<option value="col-md-6" @if($form["columns_each_row"] == "col-md-6") selected="selected" @endif >2</option>
							<option value="col-md-4" @if($form["columns_each_row"] == "col-md-4") selected="selected" @endif>3</option>
							<option value="col-md-3" @if($form["columns_each_row"] == "col-md-3") selected="selected" @endif>4</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" class="minimal" name="hide" value="1" @if($form["hide"] == 1) checked="checked" @endif> &nbsp;Hide form after submit successfuly
						</label>
					</div>
					<div class="form-group">
						<label><input type="checkbox" class="minimal" name="email" value="1" @if($form["email"] == 1) checked="checked" @endif> &nbsp;Email notification</label>
					</div>					
				</div>						
			</div>
			<div class="row form-group">
				<!-- /.col -->
				<!-- /.col -->				
				<div class="col-md-12">
					<ul id="accordion" class="field-list ui-sortable">
						@if ($form['fields_arr'])
						@php $fieldTypes= [1=>'Text',2=>'Email',3=>'Phone',4=>'Textarea',5=>'Select/Dropdown',6=>'Radio',7=>'Checkbox',8=>'Image',9=>'File']; @endphp
						@foreach($form['fields_arr'] as $fieldKey => $field)
						<li data-key="{{$fieldKey}}" style="" class="field panel field_{{$fieldKey}}">
							<span class="handle ui-sortable-handle">
								<i class="fa fa-arrows"></i>
							</span>
							<span class="text">{{$field['label']}}</span>
							<small class="label label-default">{{$fieldTypes[$field['fieldType']]}}</small>
							<div class="tools">
								<a data-toggle="collapse" data-parent="#accordion" href="#field_data_{{$fieldKey}}" aria-expanded="false">
									<i class="fa fa-edit"></i> 
								</a>
								<i class="fa fa-trash-o"></i>
							</div>
							<div id="field_data_{{$fieldKey}}" class="panel-collapse collapse">
								<div class="row">
									<div class="col-md-4"> 
										<div class="form-group"> 
											<label for="field_type_{{$fieldKey}}">Field Type</label>
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
									<div class="col-md-4">
										<div class="form-group"> 
											<label for="field_label_{{$fieldKey}}">Label <strong class="text-red">*</strong></label> 
											<input type="text" class="form-control field-label" id="field_label_{{$fieldKey}}" placeholder="Enter field label" name="field_label_['{{$fieldKey}}']" value="{{$field['label']}}" > 
										</div>
									</div> 
									<div class="col-md-4">
										<div class="form-group"> 
											<div class="form-group"> 
												<label class="col-md-12">&nbsp;</label> 
												<label><input type="checkbox" class="minimal field-required" name="field_required_['{{$fieldKey}}']" value="1" @if($field["required"] == 1) checked="checked" @endif> &nbsp;Required</label> 
											</div> 
										</div>   
									</div> 
									<div class="clearfix"></div>
									<div class="col-md-4">
										<div class="form-group"> 
											<label for="field_id_{{$fieldKey}}">Id </label>
											<input type="text" class="form-control field-id" id="field_id_{{$fieldKey}}" placeholder="Field ID (Optional)" name="field_id_['{{$fieldKey}}']" value="{{$field['id']}}"> 
										</div> 
									</div> 
									<div class="col-md-4"> 
										<div class="form-group">  
											<label for="field_class_{{$fieldKey}}">Class</label> 
											<input type="text" class="form-control field-class" name="field_class_['{{$fieldKey}}']" id="field_class_{{$fieldKey}}" placeholder="Field Class (Optional)" value="{{$field['fclass']}}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group field_placeholder_container"> 
											<label for="field_placeholder_{{$fieldKey}}">Placeholder</label>
											<input type="text" class="form-control field-placeholder" name="field_placeholder_['{{$fieldKey}}']" id="field_placeholder_{{$fieldKey}}" placeholder="Field Placeholder (Optional)" value="{{$field['placeholder']}}"> 
										</div>
										<div class="form-group field_values_container" > 
											<label for="field_values_{{$fieldKey}}">Values <strong class="text-red">*</strong></label> 
											<input type="text" class="form-control field-values" name="field_values_['{{$fieldKey}}']" id="field_values_{{$fieldKey}}" placeholder="Field values (Comma seprated. eg. value one,value two,value three)" value="{{$field['values']}}">
										</div>                 
									</div> 
									<div class="clearfix"></div>  
									<div class="col-md-6">  
										<div class="form-group">  
											<label for="field_before_{{$fieldKey}}">Before Text</label>  
											<textarea class="form-control field-before" name="field_before_['{{$fieldKey}}']" id="field_before_{{$fieldKey}}" placeholder="Text/Tag before Field (Optional)">{{$field['before']}}</textarea>  
										</div>                      
									</div>  
									<div class="col-md-6">  
										<div class="form-group">  
											<label for="field_after_{{$fieldKey}}">After Text</label>  
											<textarea id="field_after_{{$fieldKey}}" name="field_after_['{{$fieldKey}}']" class="form-control field-after" placeholder="Text/Tag after Field (Optional)">{{$field['after']}}</textarea>  
										</div>                          
									</div>                    
									<div class="clearfix"></div>  
									<div class="col-md-4">  
										<div class="form-group">  
											<label for="field_image_pos_{{$fieldKey}}">Field Image Position</label>  
											<select class="form-control select2 field-image-pos" style="width:100%;" id="field_image_pos_{{$fieldKey}}" name="field_image_pos_['{{$fieldKey}}']">  
												<option value="0" @if($field['imagePos'] == 0) selected="selected" @endif >Before Form</option>  
												<option value="1" @if($field['imagePos'] == 1) selected="selected" @endif >After Form</option>  
											</select>  
										</div>  
									</div>    
									<div class="col-md-8">  
										<div class="form-group">  
											<label for="field_image_{{$fieldKey}}">Field Image</label>
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
						</li> 
						@endforeach
						@endif
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" id="fields_json" name="fields_json" value='{{$form["fields"]}}'>
						<button type="button" class="btn btn-default add-field"><i class="fa fa-plus"></i> Add Field</button> 
						&nbsp; &nbsp; <button type="submit" name="saveform" class="btn bg-blue">Save Form</button>
						@if(Route::current()->getName() == 'single-form')
						&nbsp; &nbsp; <button type="submit" name="saveformtemplate" class="btn btn-primary" value="1">Save Form with Template</button>
						@endif
					</div>

				</div>
			</div>
		</form>
	</div>
</div>
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
@endsection
