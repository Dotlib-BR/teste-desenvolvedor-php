@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Novo Produto</h1>

                <form action="{{ route('products.update', $product) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Código de barras</label>
                        <input type="text" class="form-control" name="barcode" id="barcode" value="{{ old('barcode', $product->barcode) }}" placeholder="Ex: 99999999999999999999" required>
                    </div>
                    <div class="form-group">
                        <label for="price">E-mail</label>
                        <input type="number" step="0.01" min="0.00" class="form-control" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="0.00">
                    </div>
                    <button class="btn btn-outline-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
