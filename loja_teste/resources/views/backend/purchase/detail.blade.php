@extends('layouts.app')

@section('content')
    <h3 class="page-title">Produtos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('product.get.list') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        <i class="mdi mdi-package-variant-closed icon-md text-success"></i> {{ $product->name }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datos Pessoais</h5>
                    <p class="card-description">Produto - Informações</p>
                    <p class="font-weight-bold">Nome</p>
                    <p class="mb-5">{{ $product->name }}</p>
                    <p class="font-weight-bold">Valor Unitário</p>
                    <p class="mb-5">{{ $product->amount }}</p>
                    <p class="font-weight-bold">Código de Barras</p>
                    <p class="mb-5">{{ $product->barcode }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Compras</h5>
                    <p class="card-description">Em implementação</p>
                </div>
            </div>
        </div>

    </div>
@endsection
