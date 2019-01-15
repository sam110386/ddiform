<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'GriDBle') }}</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
	@stack('styles')
	<link href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

	<!-- Bootstrap Toggle/Switch -->
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
	<link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="index2.html" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>GDB</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>GriDBle</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{Auth::user()->avatar }}" class="user-image" alt="{{Auth::user()->name }}">
								<span class="hidden-xs">{{ Auth::user()->name }}</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="{{Auth::user()->avatar }}" class="img-circle" alt="{{Auth::user()->name }}">
									<p>
										{{ Auth::user()->name }}
										<small>Member since {{ Auth::user()->created_at->format('M d Y') }}</small>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="{{ route('profile')}}" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{Auth::user()->avatar }}" class="img-circle" alt="{{Auth::user()->name }}">
					</div>
					<div class="pull-left info">
						<p>{{ Auth::user()->name }}</p>
					</div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li>
						<a href="{{ route('home') }}">
							<i class="fa fa-globe"></i> <span>Back to Website</span>
						</a>
					</li>						
					<li class="header">MAIN NAVIGATION</li>

					<li class="@if(Route::is('dashboard') || Route::is('account') ) active @endif">
						<a href="{{ route('dashboard') }}">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>
					<li  class="@if(Route::is('profile')) active @endif">
						<a href="{{ route('profile') }}">
							<i class="fa fa-user"></i> <span>Profile</span>
						</a>
					</li>
					<li class="treeview @if (Route::is('response-email-list') || Route::is('response-data-list') || Route::is('response-list') || Route::is('all-forms') || Route::is('quick-form') || Route::is('new-form') || Route::is('single-form') || Route::is('all-form-templates'))  menu-open @endif">
						<a href="#">
							<i class="fa fa-edit"></i> <span>Forms</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="@if(Route::is('quick-form') || Route::is('single-form') || Route::is('new-form'))  active @endif"><a href="{{ route('new-form')}}"><i class="fa fa-plus"></i>New Form</a></li>
							<li class="@if(Route::is('all-forms'))  active @endif"><a href="{{ route('all-forms')}}"><i class="fa fa-file-text"></i>All Forms</a></li>
							<li class="@if(Route::is('all-form-templates'))  active @endif"><a href="{{ route('all-form-templates')}}"><i class="fa fa-file-image-o"></i>Form Templates</a></li>
							<li class="@if(Route::is('response-email-list') || Route::is('response-list') || Route::is('response-data-list'))  active @endif"><a href="{{ route('response-list')}}"><i class="fa fa-list-alt"></i>Form Responses</a></li>						
						</ul>
					</li>
					<li class="treeview @if(Route::is('convertkit-integration'))  menu-open @endif">
						<a href="#">
							<i class="fa fa-edit"></i> <span>Integrations</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="@if(Route::is('convertkit-integration'))  active @endif"><a href="{{ route('convertkit-integration')}}"><i class="fa fa-cogs"></i>Convert Kit</a></li>
						</ul>						
					</li>
					<li><a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
				</ul>
			</section>
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					@if(isset($title))
					{{$title}}
					@else
					Account
					@endif
					<small>@if(isset($description)) {{$description}} @endif</small>
				</h1>
				<ol class="breadcrumb">
					<li class="@if(!isset($title)) active @endif"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">@if(isset($title)){{$title}}@endif</li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
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

				@if (isset($flash))
				<div class="alert alert-dismissible alert-{{$flash['type']}}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					{{$flash['message']}}
				</div>
				@endif

				@yield('content')
				<div class="loader-overley">
					<div class="loader"></div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			
			<strong>Copyright &copy; {{ date('Y')}} <a href="#">GriDBle</a>.</strong> All rights
			reserved.
		</footer>
		<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->


	<!-- Scripts -->
	<!-- jQuery 3 -->
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
	<!-- daterangepicker -->
	<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<!-- datepicker -->
	<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- Sweet Alert -->
	<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
	<!-- iCheck -->
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
	
	<!-- Bootstrap Toggle/Switch -->
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	@stack('scripts')
	<script type="text/javascript" src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>	
	<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	
	<!-- AdminLTE App -->
	<script src="{{ asset('js/adminlte.min.js') }}"></script>
	<script src="{{ asset('js/common.js') }}"></script>
</body>
</html>
