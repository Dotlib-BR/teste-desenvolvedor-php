@extends('layouts.masterAdmin')
@section('title', 'Admin - Home')
@section('content')

    <section class="container">
        <div class="mt-5 home__welcome">
            @php
                $photo = $currentUser->admin_avatar ?? 'user.svg';
            @endphp
            <figure class="home__user--avatar-container">
                <img class="home__user--avatar" src="{{ url('storage/img/users/' . $photo) }}" alt="">
            </figure>
            <p class="welcome">
                Welcome Admin!
            </p>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-4 products">
                <p>
                    View all products
                </p>
                <figure>
                    <img src="" alt="">
                </figure>
                <a href="" class="btn btn-dark">Products</a>
            </div>
            <div class="col-md-4 order">
                <p>
                    View all orders
                </p>
                <a href="" class="btn btn-secondary">Orders</a>
            </div>
            <div class="col-md-4 users">
                <p>
                    View all users
                </p>
                <a href="" class="btn btn-user">Users</a>
            </div>
        </div>
    </section>
    {{-- <h2>Produtos</h2>
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
    </div> --}}

    @csrf
@endsection
