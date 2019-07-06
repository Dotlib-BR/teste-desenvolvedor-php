@auth
    <div id="navbarHeader">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ auth()->check() ? route('dashboard.index.home') : url('/') }}">{{ config('app.name', 'Dot.Lib') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ setActive(['dashboard/home*']) }}">
                        <a class="nav-link" href="{{ route('dashboard.index.home') }}">Home</a>
                    </li>
                    <li class="nav-item {{ setActive(['dashboard/clients*']) }}">
                        <a class="nav-link" href="{{ route('dashboard.clients.index') }}">Clientes</a>
                    </li>
                    <li class="nav-item {{ setActive(['dashboard/products*']) }}">
                        <a class="nav-link" href="#">Produtos</a>
                    </li>
                    <li class="nav-item {{ setActive(['dashboard/orders*']) }}">
                        <a class="nav-link" href="#">Pedidos</a>
                    </li>
                </ul>
                <div class="w-100 text-right">
                    <a class="text-decoration-none text-light fa fa-sign-out fa-2x" aria-hidden="true" href="{{ route('dashboard.user.logout') }}"></a>
                </div>
            </div>
        </nav>
    </div>
@endauth
