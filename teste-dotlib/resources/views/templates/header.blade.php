<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            DOT.LIB
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            @if(session('user'))
                <li><a href="/" class="nav-link px-2 link-dark">Home</a></li>
                @if(session('user.admin'))
                    <li><a href="/clients/id" class="nav-link px-2 link-dark">Clientes</a></li>
                @endif
                <li><a href="/products/id" class="nav-link px-2 link-dark">Produtos</a></li>
                <li><a href="/requests/date" class="nav-link px-2 link-dark">Pedidos</a></li>
            @endif


            <li><a href="/about" class="nav-link px-2 link-dark">About</a></li>
        </ul>

        <div class="col-md-3 text-end">
            @if(!session('user'))
                <a href="/login">
                    <button type="button" class="btn btn-primary me-2">Login</button>
                </a>
                <a href="/register">
                    <button type="button" class="btn btn-outline-primary">Cadastrar</button>
                </a>
            @else
                <a href="/logout">
                    <button type="button" class="btn btn-danger">Logout</button>
                </a>
            @endif
        </div>
    </header>
</div>
