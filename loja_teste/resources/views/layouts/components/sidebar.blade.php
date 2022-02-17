<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- Clientes --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#clients-nav" aria-expanded="false"
                aria-controls="clients-nav">
                <span class="menu-title">Clientes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="clients-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item" id="list-client-nav">
                        <a class="nav-link" href="{{ route('client.get.list') }}">Listar Clientes</a>
                    </li>
                    <li class="nav-item" id="create-client-nav">
                        <a class="nav-link" href="{{ route('client.get.create') }}">Cadastrar Cliente</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Products --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#products-nav" aria-expanded="false"
                aria-controls="products-nav">
                <span class="menu-title">Produtos</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-package-variant-closed menu-icon"></i>
            </a>
            <div class="collapse" id="products-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item" id="list-product-nav">
                        <a class="nav-link" href="{{ route('product.get.list') }}">Listar Produtos</a>
                    </li>
                    <li class="nav-item" id="create-product-nav">
                        <a class="nav-link" href="{{ route('product.get.create') }}">Cadastrar Produto</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Purchases --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#purchases-nav" aria-expanded="false"
                aria-controls="purchases-nav">
                <span class="menu-title">Pedidos</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-shopping menu-icon"></i>
            </a>
            <div class="collapse" id="purchases-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item" id="list-purchase-nav">
                        <a class="nav-link" href="{{ route('purchase.get.list') }}">Listar Pedidos</a>
                    </li>
                    <li class="nav-item" id="create-purchase-nav">
                        <a class="nav-link" href="{{ route('purchase.get.create') }}">Cadastrar Pedidos</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
