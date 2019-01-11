<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'DDI Forms') }}</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
	<!-- Sweet Alert -->
	<link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
	<!-- Frontend css -->
	<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

</head>
<body class="hold-transition">
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						<img class="pull-left img-responsive" width="100" src="{{ asset('img/logo.png') }}" /> 
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						<!--<li><a href="{{ route('home') }}">Home</a></li> -->
						
						@php if(Route::current()->getName()=='register'): @endphp
						<li><a href="javascript:;">Create Survey</a></li>
						@php else:@endphp
						<li><a href="{{ route('new-form') }}" @guest data-toggle="modal" data-target="#signupModal" @endguest>Create Survey</a></li>
						@php endif;@endphp
						<li><a href="{{ route('pricing') }}">Pricing</a></li>
						<li><a href="{{ route('help') }}">Help</a></li>
						@guest
						<li><a href="{{ route('login') }}">Sign in</a></li>
						<li><a href="{{ route('register') }}" class="btn-light-blue">Sign up</a></li>
						@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('account') }}">My Account</a></li>
								<li>
									<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>
	@if(session('success'))
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		{{session('success')}}
	</div>
	@endif

	@if(session('error'))
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		{{session('error')}}
	</div>
	@endif
	<section id="main">
		@yield('content')
		
	</section>
	<footer class="ptb-40 text-center">
		<div class="footer-links">
			<a href="{{ route('privacy') }}" class="text-blue-grey">Privacy</a>
			<a href="{{ route('terms') }}"  class="text-blue-grey">Terms</a>
			<a href="{{ route('help') }}"  class="text-blue-grey">Help</a>
		</div>
	</footer>
</div>


<div class="modal fade " id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="register-box-body">
					<p class="login-box-msg h3">Create Account</p>

					<form action="{{ route('register') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
							<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Full name">
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

							@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
							<span class="glyphicon glyphicon-envelope form-control-feedback "></span>
						</div>
						<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
							<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
							@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype Password" required>
							@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif					
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="row">
							<div class="col-xs-8">
								<div class="checkbox icheck">
									<label>
										<input type="checkbox" required=""> I agree to the <a href="#">terms</a>
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
							</div>
							<!-- /.col -->
						</div>
					</form>
					<a href="{{ route('password.request') }}" class="text-danger">
						Forgot Your Password?
					</a><br>
					<a href="{{ route('login') }}" class="text-center">I already have an Account</a>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- Validate Form -->
<script src="{{ asset('js/v-form.js') }}"></script>

@stack('scripts')
<script src="{{ asset('js/common.js') }}"></script>
@if($errors->has('name') || $errors->has('email') || $errors->has('password'))
<script type="text/javascript">
	$(function(){
		$('#signupModal').modal('show');
	});
</script>
@endif
</body>
</html>

