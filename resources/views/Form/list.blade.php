@extends('layouts.app')
@push('styles')
<link href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.dataTable').DataTable({
			"columns" : [
				{"orderable": false},
				null,
				null,
				null,
			]
		});
	})
</script>
@endpush
@section('content')
<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><input type="checkbox" id="check-all" /></th>
					<th>Name</th>
					<th>Url</th>
					<th>Created At</th>
					<th>Action</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($forms as $form)
				<tr>
					<td><input type="checkbox" name="keys[]" value="{{$form->form_key}}" /></td>
					<td>{{$form->name}}</td>
					<td>{{$form->form_key}}.{{URL::to('/')}}</td>
					<td>{{$form->created_at}}</td>
					<td><a href="javascript:;" class="deactivate-form" data-key="{{$form->form_key}}"><i class="fa fa-trash"></i></a>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th><input type="checkbox" id="check-all" /></th>
						<th>Name</th>
						<th>Url</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
	@endsection
