@extends('layouts.main')

@section('title', 'Mostrando pedido de compra')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-3 mb-2 text-center">
                <h4>CLIENTE</h4>
                <p>{{ $purchase->client->name }}</p>
            </div>
            <div class="col-md-3 mb-2 text-center">
                <h4>CPF DO CLIENTE</h4>
                <p>{{ maskCpf($purchase->client->cpf) }}</p>
            </div>
            <div class="col-md-3 mb-2 text-center">
                <h4>STATUS</h4>
                <p>{{ $purchase->status->title }}</p>
            </div>
            <div class="col-md-3 mb-2 text-center">
                <h4>CUPOM DE DESCONTO</h4>
                <p>{{ $purchase->discount ? $purchase->discount->code : '-' }}</p>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-9 text-center">
                <h2>Todos os itens do pedido</h2>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('dashboard.purchases.index') }}" class="btn btn-outline-light">Listagem de pedidos de compra</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table bg-dotlib table-responsive-sm text-center">
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Código de Barras</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->product->name }}</th>
                            <td>{{ formatMoney($order->product->price) }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->product->barcode }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p class="font-weight-bold">Total: <span class="text-light">{{ $orders->total() }}</span></p>
            </div>
            <div class="col-md-10 d-flex justify-content-end">
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection

