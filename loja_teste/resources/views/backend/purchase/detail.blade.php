@extends('layouts.app')

@section('content')
    <h3 class="page-title">Pedidos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('purchase.get.list') }}">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $purchase->id }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        <i class="mdi mdi-package-variant-closed icon-md text-success">
                        </i> Pedido - {{ $purchase->id }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dados do Pedido</h5>
                    <p class="card-description">Pedido - Informações</p>
                    <div class="d-flex flex-wrap text-center">
                        <div class="border border-light px-2 bd-highlight flex-fill rounded mx-1">
                            <p class="font-weight-bold">Nome do Cliente</p>
                            <p>{{ $purchase->client->name }}</p>
                        </div>
                        <div class="border border-light px-2 bd-highlight flex-fill rounded mx-1">
                            <p class="font-weight-bold">Data</p>
                            <p>{{ date('d/m/Y H:m', strtotime($purchase->date)) }}</p>
                        </div>
                        <div class="border border-light px-2 bd-highlight flex-fill rounded mx-1">
                            <p class="font-weight-bold">Valor Total</p>
                            <p>{{ $purchase->amount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-description">Produtos no Pedido</p>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Código de Barras</th>
                                <th scope="col">Valor unitário</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Valor</th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->products as $product)
                                <tr>
                                    <td scope="row" data-label="Produto">{{ $product->name }}</td>
                                    <td data-label="Código de Barras">{{ $product->barcode }}</td>
                                    <td data-label="Valor unitário">{{ $product->price }}</td>
                                    <td data-label="Quantidade">{{ $product->pivot->quantity }}</td>
                                    <td data-label="Valor">{{ $product->pivot->product_price }}</td>
                                <tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
