<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css')}}"/>
    @hasSection('css')
        @yield('css')
    @endif

</head>
<body>
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{session('error')}}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif

@yield('content')
@hasSection('js')
    @yield('js')
@endif
<script src="{{ mix('js/app.js')}}"></script>

</body>
</html>
