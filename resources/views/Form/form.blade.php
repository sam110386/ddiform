@extends('layouts.app')

@section('content')
<div class="box">
	<div class="box-body">
		<form method="POST" action="{{ route('save-form')}}">
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
							<input type="checkbox" class="minimal" name="hide"> 
							Hide form after submit successfuly
						</label>
					</div>
					<div class="form-group">
						<label><input type="checkbox" class="minimal" name="email"> Email notification</label>
					</div>					
				</div>						
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<button type="submit" class="btn bg-blue">Save Form</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
