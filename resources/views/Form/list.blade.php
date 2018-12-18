@extends('layouts.app')
@push('styles')
<link href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.dataTable').DataTable();
	})
</script>
@endpush
@section('content')
<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-hover">
			<thead>
				<tr>
					<th><input type="checkbox" id="check-all" class="minimal" /></th>
					<th>Name</th>
					<th>Url</th>
					<th>Created At</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($forms as $form)
				<tr>
					<td><input type="checkbox" name="keys[]" value="{{$form->form_key}}" class="minimal" /></td>
					<td>{{$form->name}}</td>
					<td>{{$form->form_key}}.{{str_replace_first('http://','',route('home'))}}</td>
					<td>{{$form->created_at}}</td>
					<td><center class="@if($form->status) text-green @else text-red @endif" title="@if($form->status) Active @else Inactive @endif"><i class="fa fa-circle"></i></center></td>
					<td class="form-actions">
						<a class="pull-left" href="{{ route('single-form',$form->form_key) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
						<form class="pull-left" method="POST" action="{{ route('update-form_status',['key' => $form->form_key, 'status' => ($form->status) ? 0 : 1]) }}">
							{{ csrf_field() }}
							<input type="hidden" name="key" value="{{$form->form_key}}">
							<input type="hidden" name="status" value="{{!$form->status}}">
							<button title="@if($form->status) Deactivate @else Activate @endif" type="submit" class="btn btn-link @if($form->status) text-red @else text-green @endif"><i class="fa fa-power-off"></i></button>
						</form>
					</td>
				</tr>					
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th><input type="checkbox" id="check-all" class="minimal" /></th>
					<th>Name</th>
					<th>Url</th>
					<th>Created At</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
