@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 pb-4 pb-md-0">
            @component('components.card')
                @slot('header')
                    Seus Clientes
                @endslot

                <div class="text-center py-3 m-0">
                    <strong class="h1 font-weight-bold">{{ $clients }}</strong>
                    <p class='mb-0 mt-3 h5'>Clientes</p>
                </div>

                <hr>

                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-block">Adicionar Cliente</a>
            @endcomponent
        </div>
        <div class="col-md-4 pb-4 pb-md-0">
            @component('components.card')
                @slot('header')
                    Produtos no Sistema
                @endslot

                <div class="text-center py-3 m-0">
                    <strong class="h1 font-weight-bold">{{ $products }}</strong>
                    <p class='mb-0 mt-3 h5'>Produtos</p>
                </div>

                <hr>

                <a href="{{ route('products.create') }}" class="btn btn-primary btn-block">Adicionar Produto</a>
            @endcomponent
        </div>
        <div class="col-md-4 pb-4 pb-md-0">
            @component('components.card')
                @slot('header')
                    Seus Pedidos
                @endslot

                <div class="text-center py-3 m-0">
                    <strong class="h1 font-weight-bold">{{ $orders }}</strong>
                    <p class='mb-0 mt-3 h5'>Pedidos</p>
                </div>

                <hr>

                <a href="{{ route('orders.create') }}" class="btn btn-primary btn-block">Adicionar Pedido</a>
            @endcomponent
        </div>
    </div>
</div>
@endsection
