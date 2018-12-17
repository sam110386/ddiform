@extends('layouts.app')
@push('scripts')
<script type="text/javascript" src="{{ asset('js/pages/form.js') }}"></script>
@endpush
@section('content')
<div class="box">
	<div class="box-body">
		<form class="form" method="POST" action="{{ route('save-form')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Name <strong class="text-red">*</strong></label>
						<input type="text" class="form-control" id="name" placeholder="Enter form name" value="{{old('name')}}">
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
						<textarea class="form-control" rows="3" placeholder="Enter form description"></textarea>
					</div>	
				</div>
				<div class="col-md-6">	
					<div class="form-group">
						<label>Message on submit</label>
						<textarea class="form-control" rows="3" placeholder="Enter form description"></textarea>
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="image_pos">Image Position</label>
						<select class="form-control select2" style="width:100%;" id="image_pos" name="image_pos">
							<option value="0" selected="selected">Before Form</option>
							<option value="1" >After Form</option>
						</select>
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="image">Upload Image</label>
						<input type="file" class="form-control form-image" id="image" name="image">
					</div>
				</div>							
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="columns_each_row">Columns each row</label>
						<select class="form-control select2" style="width:100%;" name="columns_each_row" id="columns_each_row">
							<option value="col-md-12" selected="selected">1</option>
							<option value="col-md-6">2</option>
							<option value="col-md-4">3</option>
							<option value="col-md-3">4</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" class="minimal" name="hide"> &nbsp;Hide form after submit successfuly
						</label>
					</div>
					<div class="form-group">
						<label><input type="checkbox" class="minimal" name="email"> &nbsp;Email notification</label>
					</div>					
				</div>						
			</div>
			<div class="row form-group">
				<!-- /.col -->
				<!-- /.col -->				
				<div class="col-md-12">
					<ul id="accordion" class="field-list ui-sortable">
						<!--li style="" class="field panel">
							<span class="handle ui-sortable-handle">
								<i class="fa fa-arrows"></i>
							</span>
							<span class="text">Field1</span>
							<small class="label label-default">2 mins</small>
							<div class="tools">
								<a data-toggle="collapse" data-parent="#accordion" href="#field_data_hello" aria-expanded="false" class="collapsed">
									<i class="fa fa-edit"></i> 
								</a>
								<i class="fa fa-trash-o"></i>
							</div>
							<div id="field_data_hello" class="panel-collapse collapse in">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="field_type_hello">Field Type</label>
											<select class="form-control select2" style="width:100%;" name="field_type['hello']" id="field_type_hello">
												<option value="1" selected="selected">Text</option>
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
									<div class="col-md-4">
										<div class="form-group">
											<label for="field_label_hello">Label <strong class="text-red">*</strong></label>
											<input type="text" class="form-control" id="field_label_hello" placeholder="Enter form name" value="">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="form-group">
												<label class="col-md-12">&nbsp;</label>
												<label><input type="checkbox" class="minimal" name="email"> &nbsp;Required</label>
											</div>	
										</div>										
									</div>
									<div class="clearfix"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="field_label_hello">Id </label>
											<input type="text" class="form-control" id="field_label_hello" placeholder="Field ID (Optional)">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="field_label_hello">Class</label>
											<input type="text" class="form-control" id="field_label_hello" placeholder="Field Class (Optional)">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="field_label_hello field_placeholder_container">Placeholder</label>
											<input type="text" class="form-control" id="field_label_hello" placeholder="Field Placeholder (Optional)">
										</div>
										<div class="form-group field_values_container" >
											<label for="field_label_hello">Values <strong class="text-red">*</strong></label>
											<input type="text" class="form-control" id="field_values_hello" placeholder="Field values (Comma seprated. eg. value one,value two,value three)">
										</div>										
									</div>
									<div class="clearfix"></div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="field_label_hello">Before Text</label>
											<textarea class="form-control" placeholder="Text/Tag before Field (Optional)"></textarea>
										</div>										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="field_label_hello">After Text</label>
											<textarea class="form-control" placeholder="Text/Tag after Field (Optional)"></textarea>
										</div>												
									</div>									
									<div class="clearfix"></div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="image_pos">Field Image Position</label>
											<select class="form-control select2" style="width:100%;" id="image_pos" name="image_pos">
												<option value="0" selected="selected">Before Form</option>
												<option value="1" >After Form</option>
											</select>
										</div>
									</div>	
									<div class="col-md-8">
										<div class="form-group">
											<label for="image">Field Image</label>
											<input type="file" class="form-control form-image" id="image" name="image">
										</div>
									</div>
								</div>
							</div>					
						</li-->			
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" id="fields_json" name="fields_json" value="">
						<button type="button" class="btn btn-default add-field"><i class="fa fa-plus"></i> Add Field</button> &nbsp; &nbsp; <button type="submit" class="btn bg-blue">Save Form</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
