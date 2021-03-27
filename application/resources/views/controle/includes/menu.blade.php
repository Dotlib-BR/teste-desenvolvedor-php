<div class="list-group list-group-flush">
    <a href="{{ route('controle.dashboard') }}" class="list-group-item list-group-item-action bg-light {{ activeMenu('controle.dashboard') }}">Dashboard</a>
    <a href="{{ route('controle.pedidos.index') }}" class="list-group-item list-group-item-action bg-light {{ activeMenu('controle.pedidos') }}">Pedidos</a>
    <a href="{{ route('controle.produtos.index') }}" class="list-group-item list-group-item-action bg-light {{ activeMenu('controle.produtos') }}">Produtos</a>
    <a href="{{ route('controle.clientes.index') }}" class="list-group-item list-group-item-action bg-light {{ activeMenu('controle.clientes') }}">Clientes</a>
    <a href="{{ route('controle.cupom.index') }}" class="list-group-item list-group-item-action bg-light {{ activeMenu('controle.cupom') }}">Cupons de desconto</a>


    <!-- <a class="list-group-item list-group-item-action bg-light" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Controle de acesso &#9660;
    </a>
    <div class="collapse" id="collapseExample">
        <a href="javascript:;" class="list-group-item list-group-item-action bg-light">Usuários</a>
        <a href="javascript:;" class="list-group-item list-group-item-action bg-light">Permissões</a>
    </div> -->
</div>
