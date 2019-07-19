@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">        
        <div class="col-md-4 my-3">
            <div class="col dashboard" id="cliente">
                <div class="clearfix my-3">
                    <div class="float-left">
                        <a href="{{route('clientes.show', Auth::user()->id)}}">Verificar Perfil</a>               
                    </div>
                    <div class="float-right">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-4 my-3">
            <div class="col dashboard" id="produto">
                <div class="clearfix my-3">
                    <div class="float-left">
                        <a href="{{route('produtos')}}">Verificar Produtos</a>                       
                    </div>
                    <div class="float-right">
                        <i class="fas fa-tag fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-3">
            <div class="col dashboard" id="produto">
                <div class="clearfix my-3">
                    <div class="float-left">
                        <a href="{{route('pedidos')}}">Verificar Pedidos</a>                        
                    </div>
                    <div class="float-right">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
