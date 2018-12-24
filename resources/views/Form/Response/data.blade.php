@extends('layouts.app')
@push('scripts')
<script> dataList = {}; </script>
<script> dataKeys = @json($form['fields_arr']); </script>
@endpush
@section('content')
<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-hover">
			<thead>
				<tr>
					@foreach($form['fields_arr'] as $field)

					<th>{{$field['label']}}</th>
					@endforeach
					<th>Action</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($form->responses as $i =>  $response)
				@push('scripts')
				<script> dataList[{{$i}}] = @json($response->data)</script>
				@endpush				
				<tr>
					@foreach($form['fields_arr'] as $key => $field)
					<td>
						@if(in_array($field['fieldType'], [8,9]) )
						<a target="_BLANK" class="@if($field['fieldType']==8) modal-img-view @endif" href="{{json_decode($response->data, true)[$key]}}" data-href="{{json_decode($response->data, true)[$key]}}">
							<i class="fa @if($field['fieldType']==8) fa-picture-o @else fa-file @endif">
							</i>
						</a>
						@else
						
						<p>{{json_decode($response->data, true)[$key]}}<p>
						@endif
					</td>
					@endforeach
					<td><a href="#" class="data-model form-data" data-modeldata='{{$i}}' data-toggle="modal" data-target="#form-data-model"><i class="fa fa-eye"></i></a></td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					@foreach($form['fields_arr'] as $field)
					<th>{{$field['label']}}</th>
					@endforeach
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
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
<div class="modal fade" id="form-data-model" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">{{$form['name']}}</h4>
			</div>
			<div class="modal-body table-responsive">
				<div class="page-loader-wrapper">
					<div class="loader">
						<div class="md-preloader pl-size-md">
							<svg viewbox="0 0 75 75">
								<circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
							</svg>
						</div>
					</div>
				</div>
				<div class="form-data-container">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
			</div>
		</div>
	</div>
</div>
@endsection
