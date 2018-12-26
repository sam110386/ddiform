@extends('layouts.app')
@push('scripts')
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
					<th>Status</th>
					<th>Created At</th>
					<th></th>
				</tr>
			</thead>	
			<tbody>
				@foreach($forms as $form)
				<tr>
					<td><input type="checkbox" name="keys[]" value="{{$form->form_key}}" class="minimal" /></td>
					<td>{{$form->name}}</td>
					<td>{{route('home')}}/{{$form->form_key}}</td>
<!-- 					<td>{{$form->form_key}}.{{str_replace_first('http://','',route('home'))}}</td>
 -->					<td>{{$form->created_at->format('M d Y')}}</td>
					<td><center class="@if($form->status) text-green @else text-red @endif" title="@if($form->status) Active @else Inactive @endif"><i class="fa fa-circle"></i></center></td>
					<td class="form-actions">
						<a class="pull-left" href="{{ route('response-data-list',$form->form_key) }}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;					
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
