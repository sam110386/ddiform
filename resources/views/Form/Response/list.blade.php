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
					<th>#</th>
					<th>Name</th>
					<th>Url</th>
					<th>Status</th>
					<th>Email Collection</th>
					<th>Responses</th>
					<th>Created At</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($forms as $form)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$form->name}}</td>
					<td>{{route('home')}}/form/{{$form->form_key}}</td>
					
					<td><center class="@if($form->status) text-green @else text-red @endif" title="@if($form->status) Active @else Inactive @endif"><i class="fa fa-circle"></i></center></td>
					<td class="form-actions">
						<center><a class="" href="{{ route('response-email-list',$form->form_key) }}"><i class="fa fa-eye"></i> &nbsp; &nbsp; {{$form->emailCollection->count()}}</a></center>
					</td>
					<td class="form-actions">
						<a class="" href="{{ route('response-data-list',$form->form_key) }}"><i class="fa fa-eye"></i> &nbsp; &nbsp; {{$form->responses->count()}}</a>
					</td>
					<td>{{$form->created_at->format('M d Y')}}</td>
				</tr>					
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Url</th>
					<th>Status</th>
					<th>Email Collection</th>
					<th>Responses</th>
					<th>Created At</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
