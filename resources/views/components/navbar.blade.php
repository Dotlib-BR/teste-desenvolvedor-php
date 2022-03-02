<nav class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">DotLib</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/" class="nav-link active" aria-current="page">
                <i class="bi bi-house-fill"></i>
                Home
            </a>
        </li>

        <li>
            <a href="/orders" class="nav-link text-white">
                <i class="bi bi-cart-check-fill"></i>
                Pedidos
            </a>
        </li>

        <li>
            <a href="/products" class="nav-link text-white">
                <i class="bi bi-box2-fill"></i>
                Produtos
            </a>
        </li>

        <li>
            <a href="/customers" class="nav-link text-white">
                <i class="bi bi-person-fill"></i>
                Clientes
            </a>
        </li>

        <br /> <br /> <br /> <br />

        <li>
            <a href="{{ route('logout') }}" class="nav-link text-white bg-danger">
                <i class="bi bi-power"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>
