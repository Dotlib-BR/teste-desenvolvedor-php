<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    @hasSection('css_after')
        @yield('css_after')
    @endif
</head>
<style>
    body{
        background: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#cbccc8)) fixed;
    }
</style>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('site.home') }}">J0Bs</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a @if(request()->route()->getName() == "site.home") class="nav-link active" @else class="nav-link" @endif href="{{ route('site.home') }}">Home
                            <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a @if(request()->route()->getName() == "site.users") class="nav-link active" @else class="nav-link" @endif href="{{ route('site.users') }}">Usuários para teste
                            </a>
                        </li>

                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest

                            <li class="nav-item">
                                <a @if(request()->route()->getName() == "auth.empresa.registro") class="nav-link active" @else class="nav-link" @endif href="{{ route('auth.empresa.registro') }}">Cadastro de empresa</a>
                            </li>

                            <li class="nav-item">
                                <a @if(request()->route()->getName() == "auth.candidato.registro") class="nav-link active" @else class="nav-link" @endif  class="nav-link" href="{{ route('auth.candidato.registro') }}">Cadastro de candidato</a>
                            </li>

                            <li class="nav-item">
                                <a @if(request()->route()->getName() == "auth.login") class="nav-link active" @else class="nav-link" @endif  class="nav-link" href="{{ route('auth.login') }}">Acesso</a>
                            </li>
                        @else
                            @if(Auth::check() && Auth::user()->perfil == 'empresa')
                            <li class="nav-item">
                                <a @if(request()->route()->getName() == "dashboard.empresa.vagas.create") class="nav-link active" @else class="nav-link" @endif href="{{ route('dashboard.empresa.vagas.create') }}">Publicar uma vaga
                                </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->nome }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->perfil == 'empresa')
                                    <a class="dropdown-item" href="{{ route('dashboard.empresa.home')}}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('dashboard.empresa.vagas.index')}}">Minhas vagas</a>
                                    <a class="dropdown-item" href="{{ route('dashboard.empresa.perfil') }}">Meus dados</a>
                                    @elseif(Auth::user()->perfil =='candidato')
                                    <a class="dropdown-item" href="{{ route('dashboard.candidato.home')}}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('dashboard.candidato.inscricoes') }}">Minhas inscrições</a>
                                    <a class="dropdown-item" href="{{ route('dashboard.candidato.perfil') }}">Meus dados</a>
                                    @else @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        toastr.options = {
            "debug": false,
            "closeButton": true,
            "positionClass": "toast-bottom-full-width",
            "onclick": null,
            "fadeIn": 500,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 2000
        }
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>
</html>
