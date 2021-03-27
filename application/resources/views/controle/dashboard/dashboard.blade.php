@extends('layouts.controle')

@section('content')


    <div class="card mb-4">
        <div class="card-header">
        Dashboard
        </div>
        <div class="card-body">
            <a href="{{ route('controle.pedidos.create') }}" class="btn btn-success btn-lg">Novo Pedido</a>
        </div>
    </div>

@endsection
