<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Forms</th>
					<th>Created At</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->phone}}</td>
					<td>{{$user->forms->count()}}</td>
					<td>{{$user->created_at->format('M d Y')}}</td>
				</tr>					
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Forms</th>
					<th>Created At</th>
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
</script>