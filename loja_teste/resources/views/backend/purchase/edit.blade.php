@extends('layouts.app')

@section('content')

<h3 class="page-title">Produtos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('product.get.list') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerenciar Produtos</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Produto - Atualização </h4>
            <p class="card-description"> Editar Produto </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="forms-sample" method="POST" action="{{ route('product.put.edit', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="productInputName" class="col-sm-3 col-form-label">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="productInputName" name="name" placeholder="Nome"
                            required minlength="3" value="{{ $product->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="productInputAmount" class="col-sm-3 col-form-label">Valor Unitário</label>
                    <div class="col-sm-9">
                        <input type="text" class="amount-mask form-control" id="productInputAmount" name="amount" placeholder="Valor Unitário"
                            required value="{{ $product->amount }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="productInputBarcode" class="col-sm-3 col-form-label">Código de Barras</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="productInputBarcode" name="barcode" 
                        placeholder="Código de Barras" value="{{ $product->barcode }}" maxlength="20">
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Atualizar</button>
                <a href="{{ route('product.get.list') }}" class="btn btn-gradient-secondary">Voltar</a>
            </form>
        </div>
    </div>

@endsection
