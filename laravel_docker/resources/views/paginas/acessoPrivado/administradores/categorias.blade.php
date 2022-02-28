@extends('modelos.acessoPrivado.administradores.Crud')



@section('styleAdicional')
    <link rel='stylesheet' type='text/css' href='..\css\modelos_acessoPrivado_geral.css'>
    <link rel='stylesheet' type='text/css' href='..\css\modelos_acessoPrivado_administradores.css'>
@endsection



@section('tituloPagina')
    Cadastros
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
    <li id="pointer-pagina-selecionada" class="my-1 text-uppercase fs-09">
        <a href="/admin/categorias">
            <span>Categorias</span>
        </a>
    </li>
    <li class="my-1 text-uppercase fs-09">
        <a href="/admin/pedidos">
            <span>Pedidos</span>
        </a>
    </li>
@endsection



<?php
    // Modelo de URL para definir ordenação na página
    $modeloUrl = '/admin/categorias';
?>



@section('Cabecario')
    <div id="#" class="d-flex fs-15 text-center">
        <div id="#" class="col-2">
            <button id="Ord1" type="button" name="ord" value="1" onclick="ordenar(document.getElementById('Ord1'))">
                <span>Id</span>
            </button>
        </div>
    
        <div id="#" class="col-3">
            <button id="Ord2" type="button" name="ord" value="2" onclick="ordenar(document.getElementById('Ord2'))">
                <span>Nome</span>
            </button>
        </div>

        <div id="#" class="col-3">
            <button id="Ord3" type="button" name="ord" value="3" onclick="ordenar(document.getElementById('Ord3'))">
                <span>Data de criação</span>
            </button>
        </div>
        
        <div id="#" class="col-3">
            <button id="Ord4" type="button" name="ord" value="4" onclick="ordenar(document.getElementById('Ord4'))">
                <span>Últime atualização</span>
            </button>
        </div>

    </div>
@endsection


@include('modelos.acessoPrivado.administradores.Categorias')
