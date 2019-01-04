@extends('layouts.app')

@section('content')
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Recent Responses</h3>
	</div>
	<div class="box-body">
		<div class="row">
			@foreach($recentForms as $form)
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{$form->name}}</h3>
					</div>
					<div class="box-body">
						@foreach($form['formChart'] as $data)
						<h5>@uppercase($data['label'])</h5>
						<div class="single-chart">
							@foreach($data['options'] as $i => $val)
							<div class="progress" data-toggle="tooltip" data-placement="top" title="{{$i}} {{$val}}%">
								<span class="chart-option pull-right p-r-10">{{$i}}</span>
								<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{$val}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$val}}%;background:#<?php echo FormResponsesController::generateRandomColorCode(); ?>;">
									<span class="pull-left p-l-10">{{$val}}%</span>
								</div>
							</div>
							@endforeach						
						</div>
						@endforeach
					</div>
				</div>
			</div> 
			@endforeach
		</div>
	</div>
</div>


@endsection
