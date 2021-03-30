@extends('layouts.masterAdmin')
@section('title', 'Admin - Registrar Produto')
@section('content')
    <h1>Admin home</h1>


    <h2>Produtos</h2>
    <div>
        @if (count($products['data']) > 0)
        @foreach ($products['data'] as $product)
                <div>
                    <input type="checkbox" class="mass__deletion--product" name="product[]" value="{{$product->id}}">

                    <a href="{{ route('editProduct', $product->id) }}">
                        <p>nome: {{ $product->name_product }}</p>
                        <p>preço: R${{ $product->price }}</p>
                    </a>
                </div>
            @endforeach
        @endif
        <button class="delete__all--product">Deleção em massa de produtos</button>
    </div>

    <h2>Pedidos</h2>
    <div>
        @if (count($orders['data']) > 0)
        @foreach ($orders['data'] as $order)
                <div>
                    <input type="checkbox" class="mass__deletion--order" name="order[]" value="{{$order->id}}">
                    <a href="{{ route('showAdmin', $order->id) }}">
                        <p>nº Pedido: {{ $order->n_order }}</p>
                        <p>preço: R${{ $order->total_price }}</p>
                    </a>
                </div>
            @endforeach
        @endif
        <button class="delete__all">Deleção em massa de pedidos</button>
    </div>

    @csrf
@endsection
