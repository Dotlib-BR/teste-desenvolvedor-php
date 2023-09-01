<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="author" content="Elder Mosé Pontello">
        <meta name="generator" content="Pontello 1.00.0">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="https://kit.fontawesome.com/2a10ab39d6.js"></script>
        
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link href="{!! url('assets/plugins/fontawesome-free/css/all.min.css') !!}" rel="stylesheet">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link href="{!! url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{!! url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{!! url('assets/plugins/jqvmap/jqvmap.min.css') !!}" rel="stylesheet">
        <!-- Theme style -->
        <link href="{!! url('assets/css/adminlte.min.css') !!}" rel="stylesheet">
        <!-- overlayScrollbars -->
        <link href="{!! url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}" rel="stylesheet">
        <!-- Daterange picker -->
        <link href="{!! url('assets/plugins/daterangepicker/daterangepicker.css') !!}" rel="stylesheet">
        <!-- summernote -->
        <link href="{!! url('assets/plugins/summernote/summernote-bs4.min.css') !!}" rel="stylesheet">
        <!-- Data Tables -->
        <link href="{!! url('assets/bootstrap/css/datatables.min.css') !!}" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed') !!}" rel="stylesheet">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{!! url('assets/img/AdminLTELogo.png') !!}" alt="AdminLTELogo" height="60" width="60">
            </div>
            @include('layouts.partials.navbar')
            @include('layouts.partials.menu')

            <main>
                @yield('content')

                <footer class="main-footer">
                <strong>Copyright &copy; {{ date("Y") }} <!--<a href="https://adminlte.io">AdminLTE.io</a>-->.</strong>
                Todos os direitos reservados.
                <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
                </div>
                </footer>
                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->

            </main>



        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{!! url('assets/plugins/jquery/jquery.min.js') !!}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{!! url('assets/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{!! url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <!-- ChartJS -->
        <script src="{!! url('assets/plugins/chart.js/Chart.min.js') !!}"></script>
        <!-- Sparkline -->
        <script src="{!! url('assets/plugins/sparklines/sparkline.js') !!}"></script>
        <!-- JQVMap -->
        <script src="{!! url('assets/plugins/jqvmap/jquery.vmap.min.js') !!}"></script>
        <script src="{!! url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') !!}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{!! url('assets/plugins/jquery-knob/jquery.knob.min.js') !!}"></script>
        <!-- daterangepicker -->
        <script src="{!! url('assets/plugins/moment/moment.min.js') !!}"></script>
        <script src="{!! url('assets/plugins/daterangepicker/daterangepicker.js') !!}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{!! url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
        <!-- Summernote -->
        <script src="{!! url('assets/plugins/summernote/summernote-bs4.min.js') !!}"></script>
        <!-- overlayScrollbars -->
        <script src="{!! url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
        <!-- AdminLTE App -->
        <script src="{!! url('assets/js/adminlte.js') !!}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{!! url('assets/js/demo.js') !!}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{!! url('assets/js/pages/dashboard.js') !!}"></script>
        <!-- Data Tables -->
        <script src="{!! url('assets/bootstrap/js/datatables.min.js') !!}"></script>

        @section("scripts")

        @show
    </body>
</html>
