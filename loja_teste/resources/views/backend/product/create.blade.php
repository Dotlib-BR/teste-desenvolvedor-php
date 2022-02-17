@extends('layouts.app')

@section('content')

<h3 class="page-title">Produtos</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.get.list') }}">Produtos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar</li>
    </ol>
</nav>


    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Produto - Cadastro</h4>
            <p class="card-description"> Cadastrar Novo Produto </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="forms-sample" method="POST" action="{{ route('product.post.create') }}">
                @csrf
                <div class="form-group row">
                    <label for="productInputName" class="col-sm-3 col-form-label">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="productInputName" name="name" placeholder="Nome do Produto"
                            required minlength="3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="productInputprice" class="col-sm-3 col-form-label">Valor Unitário</label>
                    <div class="col-sm-9">
                        <input type="text" class="amount-mask form-control" id="productInputprice" name="price" placeholder="Valor Unitário em reais do produto. Ex: 111,11"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="productInputBarcode" class="col-sm-3 col-form-label">Código de Barras</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="productInputBarcode" 
                        name="barcode" placeholder="Código de Barras do Produto" maxlength="20">
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Cadastrar</button>
            </form>
        </div>
    </div>

@endsection
