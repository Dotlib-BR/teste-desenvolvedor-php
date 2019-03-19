@extends('adminlte::page')

@section('title', 'Teste WebDev - Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Visualizar pedido</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
        <div class="col-md-12">
            <table style="width:50%">
                <tr>
                    <th>Número:</th>
                    <td>{{ $order->number }}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td>{{ $order->order_date }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>{{ $order->status }}</td>
                </tr>
                <tr>
                    <th>Cliente:</th>
                    <td>{{ $order->client->name }}</td>
                </tr>
                
            </table><br><br>
        </div>
        
        <div class="col-md-12"><hr>
        <h3>Produtos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Valor unitário</th>
                        <th scope="col">Código de barras</th>
                        <th scope="col">Quantidade do produto</th>
                        <th scope="col">Quantidade do pedido</th>
                    </tr>
                </thead>
                <tbody class="products-list">
                @foreach ($products as $key => $product)
                    <tr id=''>
                        <th scope='row'>{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{ 'R$ ' . number_format($product->price, 2, ',', '.') }}</td>
                        <td>{{$product->bar_code}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$qtt[$product->id][0]->qtd_order}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-info"
                onclick="location.href='{{ route('orders.index') }}'">Voltar
            </button>
            </div>
        </div>
    </div>
@stop


