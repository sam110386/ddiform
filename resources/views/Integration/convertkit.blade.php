@extends('layouts.app')
@section('content')
<div class="box">
	<div class="box-body">
		<form class="form" method="POST" action="{{route('convertkit-integration-save')}}">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-5">
					<div class="form-group {{ $errors->has('api_key') ? ' has-error' : '' }}">
						<label for="api_key">API KEY</label>
						<input type="text" class="form-control" id="api_key" placeholder="Enter form name" value="@if(old('api_key')){{old('api_key')}}@else{{ $credentials['api_key'] }}@endif" name="api_key">
						@if ($errors->has('api_key'))
						<span class="help-block">
							<strong>{{ $errors->first('api_key') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group {{ $errors->has('api_secret') ? ' has-error' : '' }}">
						<label for="api_secret">API SECRET</label>
						<input type="text" class="form-control" id="api_secret" placeholder="Enter form name" value="@if(old('api_secret')){{old('api_secret')}}@else{{ $credentials['api_secret'] }}@endif" name="api_secret">
						@if ($errors->has('api_secret'))
						<span class="help-block">
							<strong>{{ $errors->first('api_secret') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>&nbsp;</label>
						<input type="submit" value="Save" class="form-control btn btn-primary">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection