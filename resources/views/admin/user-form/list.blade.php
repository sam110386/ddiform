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
					<td>{{route('home')}}/form/{{$form->form_key}}</td>
					<td>{{$form->created_at->format('M d Y')}}</td>
					<td><center class="@if($form->status) text-green @else text-red @endif" title="@if($form->status) Active @else Inactive @endif"><i class="fa fa-circle"></i></center></td>
					<td class="form-actions">
						<center><a class="" href="{{ route('admin-response-email-list',$form->form_key) }}"><i class="fa fa-eye"></i> &nbsp; &nbsp; {{$form->emailCollection->count()}}</a></center>
					</td>
					<td class="form-actions">
						<a class="" href="{{ route('admin-response-data-list',$form->form_key) }}"><i class="fa fa-eye"></i> &nbsp; &nbsp; {{$form->responses->count()}}</a>
					</td>					
					<td class="form-actions">
						<form class="pull-left" method="POST" action="{{ route('admin-update-form-status',['key' => $form->form_key, 'status' => ($form->status) ? 0 : 1]) }}">
							{{ csrf_field() }}
							<input type="hidden" name="key" value="{{$form->form_key}}">
							<input type="hidden" name="status" value="{{!$form->status}}">
							<button title="@if($form->status) Deactivate @else Activate @endif" type="submit" class="btn btn-link @if($form->status) text-red @else text-green @endif"><i class="fa fa-power-off"></i></button>
						</form>
						<form class="pull-left remove-form" id="remove-form-{{$form->form_key}}" method="POST" action="{{ route('admin-remove-form',['key' => $form->form_key]) }}">
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.dataTable').DataTable();
	});
	$(document).on('submit','.remove-form',function(e){
		e.preventDefault();
		var form = $(this).attr('id');
		Swal({
			title: 'Are you sure?',
			text: "You will not be able to recover this form!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$("#"+form)[0].submit();
			}
		})		
	});	

</script>