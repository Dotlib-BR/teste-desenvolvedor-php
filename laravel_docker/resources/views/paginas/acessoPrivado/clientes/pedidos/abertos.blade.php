@extends('modelos.acessoPrivado.geral.CrudPedidos')



@section('tituloPagina')
    Meus Pedidos
@endsection


@section('pointerPagina')
    <li id="pointer-pagina-selecionada" class="my-1 text-uppercase fs-09">
        <a href="/meus-pedidos/abertos">
            <span>Em Aberto</span>
        </a>
        
    </li>
    <li class="my-1 text-uppercase fs-09">
        <a href="/meus-pedidos/pagos">
            <span>Pagos</span>
        </a>
    </li>
    <li class="my-1 text-uppercase fs-09">
        <a href="/meus-pedidos/cancelados">
            <span>Cancelados</span>
        </a>
    </li>
@endsection


<?php
    // Modelo de URL para definir ordenação na página
    $urlDaPagina = '/meus-pedidos/abertos';
    $palavraChave = 'abertos';
?>


@include('paginas.acessoPrivado.clientes.pedidos.pedidos')