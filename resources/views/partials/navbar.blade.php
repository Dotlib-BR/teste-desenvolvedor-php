<nav class="navbar navbar-expand-md navbar-light bg-primary">
    <div class="container">
        <a class="navbar-brand text-white d-inline-none-md" href="{{ route('home') }}">Teste dot.lib</a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>

                <!-- Clients -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdownClients" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Clientes
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownClients">
                        <a class="dropdown-item" href="{{ route('clients.index') }}">Ver Todos</a>
                        <a class="dropdown-item" href="{{ route('clients.create') }}">Adicionar Novo</a>
                    </div>
                </li>

                <!-- Products -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdownProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produtos
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownProducts">
                        <a class="dropdown-item" href="{{ route('products.index') }}">Ver Todos</a>
                        <a class="dropdown-item" href="{{ route('products.create') }}">Adicionar Novo</a>
                    </div>
                </li>

                <!-- Orders -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdownOrders" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pedidos
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownOrders">
                        <a class="dropdown-item" href="{{ route('orders.index') }}">Ver Todos</a>
                        <a class="dropdown-item" href="{{ route('orders.create') }}">Adicionar Novo</a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>