<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table class="dataTable table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created At</th>
				</tr>
			</thead>	
			<tbody>
				@foreach($collections as $collection)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$collection->name}}</td>
					<td>{{$collection->email}}</td>
					<td>{{$collection->created_at->format('M d Y')}}</td>
				</tr>					
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
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