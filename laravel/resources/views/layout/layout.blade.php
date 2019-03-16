<!doctype html>
<html>

<head>

  <meta name="_token" content="{{csrf_token()}}" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{url('bootstrap-4.3.1/css/bootstrap.min.css')}}">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="{{url('bootstrap-4.3.1/js/bootstrap.min.js')}}" ></script>
</head>

<body>
  <script>
    var BASE_URL = "{{URL("/")}}"
  </script>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        <a class="nav-link" href="{{URL('dashboard')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{URL('dashboard/produto')}}">Produto <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{url('logout')}}">Sair</a>
        </li>


    </div>
  </nav>

  <div Class="container">
    <div class="col-md-12" style="margin-top:25px;">
        <h4 class="text-center">{{!empty($title) ? $title  : config('app.name')}}</h4>
    </div>

    @yield("content")
  </div>


  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>