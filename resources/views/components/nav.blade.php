 @if (Route::has('login'))
<ul class="navbar-nav ml-auto">
    @auth

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">Área Interna</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Acessar</a>
        </li>
    @endauth
</ul>
@endif




