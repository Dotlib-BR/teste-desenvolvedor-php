@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Novo Produto</h1>

                <form action="{{ route('products.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="barcode">Códico de barras</label>
                        <input type="text" class="form-control" name="barcode" id="barcode">
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="number" step=".01" min="0.00" class="form-control" name="price" id="price" placeholder="0.00">
                    </div>
                    <button class="btn btn-outline-primary">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
