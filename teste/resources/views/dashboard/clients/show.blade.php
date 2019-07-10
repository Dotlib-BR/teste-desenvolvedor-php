@extends('layouts.main')

@section('title', 'Mostrando cliente')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-3 mb-2 text-center">
                <h4>NOME</h4>
                <p>{{ $client->name }}</p>
            </div>
            <div class="col-md-3 mb-2 text-center">
                <h4>CPF</h4>
                <p>{{ maskCpf($client->cpf) }}</p>
            </div>
            <div class="col-md-3 mb-2 text-center">
                <h4>EMAIL</h4>
                <p>{{ $client->email ?? '-' }}</p>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-9 text-center">
                <h2>Todos os pedidos de compra</h2>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('dashboard.clients.index') }}" class="btn btn-outline-light">Listagem de clientes</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table bg-dotlib table-responsive-sm">
                    <thead>
                    <tr>
                        <th scope="col">Nota Fiscal</th>
                        <th scope="col">Total</th>
                        <th scope="col">Desconto</th>
                        <th scope="col">Total com Desconto</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($purchases as $purchase)
                        <tr>
                            <th scope="row">{{ $purchase->invoice_number }}</th>
                            <td>{{ totalWithDiscount($purchase->total, 0) }}</td>
                            <td>{{ $purchase->discount ? $purchase->discount->code : '-' }} <sup>{{ $purchase->discount ? $purchase->discount->percentage.'%' : '-' }}</sup></td>
                            <td>{{ totalWithDiscount($purchase->total, $purchase->discount ? $purchase->discount->percentage : null) }}</td>
                            <td>{{ $purchase->status->title }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
                            <td>-</td>
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
                <p class="font-weight-bold">Total: <span class="text-light">{{$purchases->total() }}</span></p>
            </div>
            <div class="col-md-10 d-flex justify-content-end">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
@endsection

