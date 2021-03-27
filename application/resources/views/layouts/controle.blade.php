<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Área administrativa - {{ config('app.name', 'Laravel') }}</title>

  <!-- Bootstrap core CSS -->

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="/css/simple-sidebar.css" rel="stylesheet">

  <style>
      .w-5{
        max-width: 25px !important;
      }
      .h-5 {
        max-height: 25px !important;
      }
      span.select2-selection.select2-selection--single {
        min-height: 37px;
      }
  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    @auth
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">{{ __('Admin') }} </div>
      @include('controle.includes.menu')
    </div>
    <!-- /#sidebar-wrapper -->
    @endauth
    <!-- Page Content -->
    <div id="page-content-wrapper">
        @auth
            @include('controle.includes.navbar')
        @endauth
        <div class="container-fluid mt-5">
            @include('controle.includes.mensagem')
            @yield('content')
        </div>

    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <!-- Scripts -->
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('library/css/vendor.css') }}">
  <script src="{{ asset('library/js/vendor.js') }}"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $('.atencao').click(function() {
        if(confirm('Deseja excluir o registro?')) {
            return;
        } else {
            return false;
        }
    });
    $('.select2').select2({
        placeholder: 'Selecione'
    });
  </script>

  @yield('scripts')

</body>

</html>

