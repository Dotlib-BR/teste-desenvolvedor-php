@extends('layout.navbar')

@section('title', 'Pedidos')

@section('style')

        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@endsection

@section('content')

    <div class="container"  style="margin-top: 5%">
        <div style="display: flex;justify-content: space-between" class="card-header py-2 mb-3">
            <h1 class="mt-3">Pedidos</h1>
            <div class="search-box mt-3">
                <div class="title-search-blog">Pesquisar</div>
                <form action="{{ route('orders.search') }}" method="POST">
                    @csrf
                    <input class="search-field" id="search" type="text" name="search" placeholder="Faça sua busca">
                </form>
            </div>
            <a href="{{ route('pedidos.create') }}" class="btn btn-success my-2" style="margin-bottom: 1.5rem!important;">Novo Pedido</a>
        </div>
        <!--- Tabela com hover e zebrada--->
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Preço total</th>
                <th scope="col">Data</th>
                <th scope="col">Status</th>
                <th scope="col">Detalhes</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->client->name }}</td>
                <td>R$ {{ $order->total_price }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ $order->status }}</td>
                <!-- botao detalhes -->
            <td><button type="button" title="Detalhes do Pedido" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success">Ver mais</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a class="active" href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
        </div>
    </div>

    <!-- Modal de Detalhes -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pedido</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>R$ {{ $product->price }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>R$ {{ $product->pivot->quantity * $product->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
