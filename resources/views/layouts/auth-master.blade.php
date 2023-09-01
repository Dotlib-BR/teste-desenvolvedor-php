<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        {{-- <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css"> --}}
        <link href="{!! url('assets/plugins/fontawesome-free/css/all.min.css') !!}" rel="stylesheet">
        <!-- icheck bootstrap -->
        {{-- <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> --}}
        <link href="{!! url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}" rel="stylesheet">
        <!-- Theme style -->
        {{-- <link rel="stylesheet" href="assets/css/adminlte.min.css"> --}}
        <link href="{!! url('assets/css/adminlte.min.css') !!}" rel="stylesheet">

    </head>
    <body class="hold-transition login-page">

        @yield('content')

        <!-- jQuery -->
        {{-- <script src="../../plugins/jquery/jquery.min.js"></script> --}}
        <script src="{!! url('assets/plugins/jquery/jquery.min.js') !!}"></script>
        <!-- Bootstrap 4 -->
        {{-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
        <script src="{!! url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <!-- AdminLTE App -->
        {{-- <script src="../../dist/js/adminlte.min.js"></script> --}}
        <script src="{!! url('assets/js/adminlte.min.js') !!}"></script>
        <!-- Scripts do App -->
        <script src="{!! url('assets/js/app.js') !!}"></script>
    </body>
</html>
