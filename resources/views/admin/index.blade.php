<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Admin::title() }} @if($header) | {{ $header }}@endif</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {!! Admin::css() !!}

    <script src="{{ Admin::jQuery() }}"></script>
    <link href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">
    <div class="wrapper">

        @include('admin::partials.header')

        @include('admin::partials.sidebar')

        <div class="content-wrapper" id="pjax-container">
            <div id="app">
                @yield('content')
            </div>
            {!! Admin::script() !!}
        </div>

        @include('admin::partials.footer')

    </div>

    <script>
        function LA() {}
        LA.token = "{{ csrf_token() }}";
    </script>

    <!-- REQUIRED JS SCRIPTS -->
    {!! Admin::js() !!}
    <script type="text/javascript" src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> 
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/pages/form.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
</body>
</html>
