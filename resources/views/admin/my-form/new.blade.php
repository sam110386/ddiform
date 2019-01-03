@extends('layouts.app')
@section('content')
<div class="box">
	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
				<ul class="list-group">
					<li class="list-group-item active" ><span class="text-uppercase"><strong>Choose from saved template</strong></span></li>
					@forelse($UserFormTemplates as $template)
					<li class="list-group-item">
						{{$template->name}}
						<a href="{{ route('quick-form',$template->template_key) }}"  class="btn btn-primary btn-xs pull-right ">
							select
						</a>
					</li>
					@empty
						<li class="list-group-item">No template found.</li>
					@endforelse
				</ul>
				<small class="text-red"><strong>NOTE:</strong>This will create new form with selected template structure.</small>
			</div>
			<div class="col-md-1 text-center ">
				<p class="h1">OR</p>
			</div>
			<div class="col-md-5 ">
				<a href="{{route('single-form')}}" class="btn btn-primary btn-block btn-lg">Create new</a>
			</div>
		</div>
	</div>
</div>
@endsection