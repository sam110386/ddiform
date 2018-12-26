<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
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
	<link rel="stylesheet" href="{{ asset('css/render.css') }}">

</head>
<body class="hold-transition">
	<div id="app" class="m-t-50">
		@yield('content')
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

