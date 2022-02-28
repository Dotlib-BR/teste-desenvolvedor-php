@extends('modelos.acessoPrivado.geral.CrudPedidos')



@section('tituloPagina')
    Meus Pedidos
@endsection


@section('pointerPagina')
    <li class="my-1 text-uppercase fs-09">
        <a href="/meus-pedidos/abertos">
            <span>Em Aberto</span>
        </a>
        
    </li>
    <li class="my-1 text-uppercase fs-09">
        <a href="/meus-pedidos/pagos">
            <span>Pagos</span>
        </a>
    </li>
    <li id="pointer-pagina-selecionada" class="my-1 text-uppercase fs-09">
        <a href="/meus-pedidos/cancelados">
            <span>Cancelados</span>
        </a>
    </li>
@endsection


<?php
    // Modelo de URL para definir ordenação na página
    $modeloUrl = '/meus-pedidos/cancelados';
?>


@section('ListaDePedidos')

    <div id="carrinho-item" class="my-4 d-flex text-center align-items-center">
        <!-- Imagem do produto -->
        <div id="#carrinho-produto-imagem" class="col">
            <img class="w-25" src="">
            <span>Fotinha bonita</span>
        </div>
        <!-- Nome do Produto -->
        <div id="#carrinho-produto-nome" class="col">
            <span>Nome</span>
        </div>
        <!-- Preço do Produto -->
        <div id="#carrinho-produto-valor" class="col">
            <span>Preço</span>
        </div>
        <!-- Quantidade no Carrinho -->
        <div id="#carrinho-produto-quantidade" class="col">
            <span>Quantidade</span>
        </div>
        <!-- Status -->
        <div id="carrinho-produto-status" class="col">
            <a href="/meus-pedidos?id=1">
                <button class="btn btn-outline-danger" type="button">Cancelado</button>
            </a>
        </div>
        <div id="#carrinho-valor-final" class="col">
            <span>Valor Final</span>
        </div>
    </div>

@endsection