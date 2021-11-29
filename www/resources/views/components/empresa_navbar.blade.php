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
                <li class="nav-item">
                    <a @if(request()->route()->getName() == "dashboard.empresa.vagas.create") class="nav-link active" @else class="nav-link" @endif href="{{ route('dashboard.empresa.vagas.create') }}">Publicar uma vaga
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->nome }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard.empresa.home')}}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('dashboard.empresa.vagas.index')}}">Minhas vagas</a>
                        <a class="dropdown-item" href="{{ route('dashboard.empresa.perfil') }}">Meus dados</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('auth.logout') }}">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
