<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    <div id="app">
        @auth
            @include('partials.navbar')
        @endauth

        <main class="py-5">
            @auth
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            @include('partials.alert')
                        </div>
                    </div>
                </div>
            @endauth
            
            @yield('content')
        </main>
    </div>

    <!-- Modals -->
    @stack('modal')
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</body>
</html>
