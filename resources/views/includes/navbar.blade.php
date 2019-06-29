<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto mr-auto text-uppercase text-weight-bold">
                <li class="nav-item {{ (request()->route()->getName() == 'home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Início</a>
                </li>
                <li class="nav-item {{ (request()->route()->getName() == 'users.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">Usuários</a>
                </li>
                <li class="nav-item {{ (request()->route()->getName() == 'products.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products.index') }}">Produtos</a>
                </li>
                <li class="nav-item {{ (request()->route()->getName() == 'orders.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('orders.index') }}">Pedidos</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-3 mb-lg-0">
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        Desconectar
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
