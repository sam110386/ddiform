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
						<img class="pull-left img-responsive" width="25" src="{{ asset('img/logo.png') }}" /> &nbsp; {{ config('app.name', 'DDI Form') }}
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						<!--<li><a href="{{ route('home') }}">Home</a></li> -->
						<li><a href="{{ route('new-form') }}">Create Survey</a></li>
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
			<a href="#" class="text-blue-grey">Privacy</a>
			<a href="#"  class="text-blue-grey">Terms</a>
			<a href="#"  class="text-blue-grey">Support</a>
		</div>
	</footer>
</div>
<div class="loader-overley">
	<div class="loader"></div>
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
</body>
</html>

