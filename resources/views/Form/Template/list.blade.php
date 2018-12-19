@extends('layouts.app')
@section('content')
<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-hover">
			<thead>
				<tr>
					<th><input type="checkbox" id="check-all" class="minimal" /></th>
					<th>Name</th>
					<th>Created At</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($templates as $template)
				<tr>
					<td><input type="checkbox" name="keys[]" value="{{$template->template_key}}" class="minimal" /></td>
					<td>{{$template->name}}</td>
					<td>{{$template->created_at->format('M d Y')}}</td>
					<td><center class="@if($template->status) text-green @else text-red @endif" title="@if($template->status) Active @else Inactive @endif"><i class="fa fa-circle"></i></center></td>
					<td class="form-actions">
						<form class="pull-left" method="POST" action="{{ route('update-template-status',['key' => $template->template_key, 'status' => ($template->status) ? 0 : 1]) }}">
							{{ csrf_field() }}
							<input type="hidden" name="key" value="{{$template->template_key}}">
							<input type="hidden" name="status" value="{{!$template->status}}">
							<button title="@if($template->status) Deactivate @else Activate @endif" type="submit" class="btn btn-link @if($template->status) text-red @else text-green @endif"><i class="fa fa-power-off"></i></button>
						</form>
					</td>
				</tr>					
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th><input type="checkbox" id="check-all" class="minimal" /></th>
					<th>Name</th>
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
