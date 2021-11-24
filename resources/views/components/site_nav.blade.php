 @if (Route::has('login'))
    <nav class="my-2 my-md-0 mr-md-3">
    @auth
        <a class="p-2 text-dark" href="{{ route('dashboard') }}">Área Interna</a>
        <a class="p-2 text-dark" href="#"> {{ Auth::user()->name }}</a>
        <a class="p-2 text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Sair</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @else
        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Acessar</a>
        @endauth
    </nav>
@endif




