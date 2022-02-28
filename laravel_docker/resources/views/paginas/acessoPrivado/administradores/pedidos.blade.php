@extends('modelos.acessoPrivado.administradores.Crud')



@section('styleAdicional')
    <link rel='stylesheet' type='text/css' href='..\css\modelos_acessoPrivado_geral.css'>
    <link rel='stylesheet' type='text/css' href='..\css\modelos_acessoPrivado_administradores.css'>
@endsection



@section('tituloPagina')
    Pedidos
@endsection



@section('pointerPagina')
    <li class="my-1 text-uppercase fs-09">
        <a href="/admin/cadastros">
            <span>Cadastros</span>
        </a>
        
    </li>
    <li class="my-1 text-uppercase fs-09">
        <a href="/admin/produtos">
            <span>Produtos</span>
        </a>
    </li>
    <li class="my-1 text-uppercase fs-09">
        <a href="/admin/categorias">
            <span>Categorias</span>
        </a>
    </li>
    <li id="pointer-pagina-selecionada" class="my-1 text-uppercase fs-09">
        <a href="/admin/pedidos">
            <span>Pedidos</span>
        </a>
    </li>
@endsection



<?php
    // Modelo de URL para definir ordenação na página
    $modeloUrl = '/admin/pedidos';
?>



@section('Cabecario')

    <div id="#" class="d-flex fs-12 text-center">
        <div id="#" class="col-1">
            <button id="Ord1" type="button" name="ord" value="1" onclick="ordenar(document.getElementById('Ord1'))">
                <span>Id</span>
            </button>
        </div>
    
        <div id="#" class="col-2">
            <button id="Ord2" type="button" name="ord" value="2" onclick="ordenar(document.getElementById('Ord2'))">
                <span>CadastroID</span>
            </button>
        </div>

        <div id="#" class="col-2">
            <button id="Ord3" type="button" name="ord" value="3" onclick="ordenar(document.getElementById('Ord3'))">
                <span>CarrinhoID</span>
            </button>
        </div>

        <div id="#" class="col-1">
            <button id="Ord4" type="button" name="ord" value="4" onclick="ordenar(document.getElementById('Ord4'))">
                <span>Status</span>
            </button>
        </div>

        <div id="#" class="col-2">
            <button id="Ord5" type="button" name="ord" value="5" onclick="ordenar(document.getElementById('Ord5'))">
                <span>Cod Barras</span>
            </button>
        </div>

        <div id="#" class="col-2">
            <button id="Ord6" type="button" name="ord" value="6" onclick="ordenar(document.getElementById('Ord6'))">
                <span>Data</span>
            </button>
        </div>

        <div id="#" class="col-2">
            <button id="Ord7" type="button" name="ord" value="7" onclick="ordenar(document.getElementById('Ord7'))">
                <span>Última atualização</span>
            </button>
        </div>
    </div>

@endsection


@include('modelos.acessoPrivado.administradores.Pedidos')
