@extends('layouts.form')
@push('scripts')
<script type="text/javascript" src="{{ asset('js/pages/render.js') }}"></script>
<script  type="text/javascript">
	var emailCollection = parseInt("{{$form['email_collection']}}");
	var showResponse = parseInt("{{$form['auto_response']}}");
	var responseText = "{{$form->response_text}}";
	var bootCss = "{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}";
	var renderCss = "{{ asset('css/render.css') }}";
	var appLang = "{{ app()->getLocale() }}";
	var formTitle = "{{$form->name}}";
</script>
@endpush
@section('content')
<div class="container ddi-form-container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="box-title">{{$form->name}}</h3>
		</div>
		@if($form['image'] && $form['image_pos'] == 0)
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<img src="{{$form['image']}}" class="img-responsive" />
				</div>
			</div>
		</div>
		@endif		
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>{!! nl2br(e($form->description)) !!}</p>
				</div>
			</div>
			<form id="ddi-form" class="ddi-form" action="{{route('save-form-data',$form['form_key'])}}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="row">
					<?php $fieldsCount = 0; ?>
					@if($form->columns_each_row == 'col-md-6')
					<?php $fieldsEachRow = 2; ?>
					@elseif($form->columns_each_row == 'col-md-4')
					<?php $fieldsEachRow = 3; ?>
					@elseif($form->columns_each_row == 'col-md-3')
					<?php $fieldsEachRow = 4; ?>
					@else
					<?php $fieldsEachRow = 1; ?>
					@endif
					@foreach($form->fields_arr as $key => $field)
					<div class="{{$form->columns_each_row}}">
						@if($field['before'])
						<p>{{$field['before']}}</p>
						@endif
						@if(isset($field['image']) && $field['imagePos'] == 0)
						<div class="form-group ">
							<img src="{{$field['image']}}" class="img-responsive" />
						</div>
						@endif
						<?php echo FormResponsesController::generateField($key,$field); $fieldsCount++; ?>
						@if(isset($field['image']) && $field['imagePos'] == 1)
						<div class="form-group ">
							<img src="{{$field['image']}}" class="img-responsive" />
						</div>					
						@endif
						@if($field['after'])
						<p>{{$field['after']}}</p>
						@endif							
					</div>
					@if($fieldsEachRow == $fieldsCount)
					<div class="clearfix"></div>
					<?php $fieldsCount = 0; ?>
					@endif
					@endforeach
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group ">
							<button type="submit" class="btn btn-primary">
								@if($form['submit_text'])
								{{$form['submit_text']}}
								@else
								Submit
								@endif
							</button>
						</div>
					</div>
				</div>
			</form>	
		</div>
		@if($form['image'] && $form['image_pos'] == 1)
		<div class="row">
			<div class="col-md-12">
				<img src="{{$form['image']}}" class="img-responsive" />
			</div>
		</div>
		@endif
		<p class="text-center"><a class="text-muted" href="{{route('home')}}" target="_BLANK">Powered by GriDBle</a></p>	
	</div>
</div>
@if($form['email_collection'])
<!-- Start email collection form -->
<div class="container email-collection-form-container" style="display:none;">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3>{{$form['email_collection_title']}}</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form id="email-collection-form" class="form-horizontal email-collection-form" action="{{route('save-email-collection',$form['form_key'])}}">
					{{ csrf_field() }}
					<div class="panel-body">
						@if($form['name_collection'])
						<div class="form-group error-heading">
							<label for="collection-name" class="col-sm-2 control-label">Name <small class="text-red">*</small></label>
							<div class="col-sm-10">
								<input type="text" class="form-control vf-required" id="collection-name" placeholder="Name" name="name">
							</div>
						</div>
						@endif
						<div class="form-group error-heading">
							<label for="collection-email" class="col-sm-2 control-label">Email <small class="text-red">*</small></label>
							<div class="col-sm-10">
								<input type="email" class="form-control vf-required vf-email" id="collection-email" placeholder="Email" name="email">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10 col-md-offset-2 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">{{$form['submit_text']}}</button>
							</div>
						</div>
						<div class="form-group agree-check error-heading">
							<div class="">
								<div class="col-md-2 col-xs-1 text-right">
									<div class="checkbox icheck">
										<label class="col-md-10 col-md-offset-2" style="padding-left: 0;">
											<input id="agree-check" type="checkbox" name="agree-check" class="vf-required">
										</label>
									</div>
								</div>
								<label for="agree-check" class="col-md-10 col-xs-10">
									I agree to leave Medium and submit this information, which will be collected and used according to <a target="_BLANK" href="{{route('privacy')}}">griDBle's privacy policy</a>.
									<br>
									<label class="error"><small>Please select the checkbox to proceed</small></label>
								</label>
							</div>
						</div>				
					</div>
					<!-- /.box-body -->
				</form>
				<p class="text-center"><a class="text-muted" href="{{route('home')}}" target="_BLANK">Powered by GriDBle</a></p>
			</div>
		</div>
	</div>
</div>
<!-- End email collection form -->
@endif
<div class="container response-container m-b-50 " style="display:none;">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3>{{$form->name}} - Results</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12 user-reposnse">
					<div class="chart p-b-50">
					</div>
				</div>
			</div>
		</div>
		<p class="text-center"><a class="text-muted" href="{{route('home')}}" target="_BLANK">Powered by GriDBle</a></p>
	</div>
</div>
<div class="hidden">
	<form id="response-form" action="{{route('form-response-chart',$form['form_key'])}}">
		{{csrf_field()}}
	</form>
</div>
@endsection