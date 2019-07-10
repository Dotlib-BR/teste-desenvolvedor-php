@extends('layouts.main')

@section('title', 'Mostrando producte')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-4 mb-2 text-center">
                <h4>NOME</h4>
                <p>{{ $product->name }}</p>
            </div>
            <div class="col-md-5 mb-2 text-center">
                <h4>CÓDIGO DE BARRAS</h4>
                <p>{{ $product->barcode }}</p>
            </div>
            <div class="col-md-3 mb-2 text-center">
                <h4>PREÇO</h4>
                <p>{{ formatMoney($product->price) }}</p>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-9 text-center">
                <h2>Todos as saídas do estoque</h2>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-light">Listagem de produtos</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table bg-dotlib table-responsive-sm text-center">
                    <thead>
                    <tr>
                        <th scope="col">Nota Fiscal</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->purchase->invoice_number }}</th>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
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

