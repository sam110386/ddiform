@extends('layouts.app')
@push('scripts')
<script type="text/javascript" src="{{ asset('js/pages/form.js') }}"></script>
@endpush
@section('content')
<script type="text/javascript">
      var $body = document.getElementsByTagName('body')[0];
      function copyToClipboard(secretInfo) {
        var $tempInput = document.createElement('INPUT');
        $body.appendChild($tempInput);
        $tempInput.setAttribute('value', secretInfo)
        $tempInput.select();
        document.execCommand('copy');
        $body.removeChild($tempInput);
      }
      
    </script>
<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Url</th>
					<th>Created At</th>
					<th>Status</th>
					<th>Email Collections</th>
					<th>Responses</th>
					<th>Action</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($forms as $form)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$form->name}}</td>
					<td>{{route('render-form',$form->form_key)}} <a href="javascript:;" onclick='copyToClipboard("{{route('render-form',$form->form_key)}}")'><i class="fa fa-copy fa-lg"></i></a></td>
					<td>{{$form->created_at->format('M d Y')}}</td>
					<td><center class="@if($form->status) text-green @else text-red @endif" title="@if($form->status) Active @else Inactive @endif"><i class="fa fa-circle"></i></center></td>
					<td class="form-actions">
						<center><a class="" href="{{ route('response-email-list',$form->form_key) }}"><i class="fa fa-eye"></i> &nbsp; &nbsp; {{$form->emailCollection->count()}}</a></center>
					</td>
					<td class="form-actions">
						<a class="" href="{{ route('response-data-list',$form->form_key) }}"><i class="fa fa-eye"></i> &nbsp; &nbsp; {{$form->responses->count()}}</a>
					</td>					
					<td class="form-actions">
						<a class="pull-left" href="{{ route('single-form',$form->form_key) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
						<form class="pull-left" method="POST" action="{{ route('update-form-status',['key' => $form->form_key, 'status' => ($form->status) ? 0 : 1]) }}">
							{{ csrf_field() }}
							<input type="hidden" name="key" value="{{$form->form_key}}">
							<input type="hidden" name="status" value="{{!$form->status}}">
							<button title="@if($form->status) Deactivate @else Activate @endif" type="submit" class="btn btn-link @if($form->status) text-red @else text-green @endif"><i class="fa fa-power-off"></i></button>
						</form>
						<form class="pull-left remove-form" id="remove-form-{{$form->form_key}}" method="POST" action="{{ route('remove-form',['key' => $form->form_key]) }}">
							{{ csrf_field() }}
							<input type="hidden" name="key" value="{{$form->form_key}}">
							<input type="hidden" name="_method" value="delete" />
							<button title="Remove" type="submit" class="btn btn-link text-red">
								<i class="fa fa-trash"></i>
							</button>
						</form>						
					</td>
				</tr>					
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Url</th>
					<th>Created At</th>
					<th>Status</th>
					<th>Email Collections</th>
					<th>Responses</th>					
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
