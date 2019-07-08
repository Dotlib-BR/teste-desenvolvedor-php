@extends('layouts.main')

@section('title', isset($product) ? 'Edição de Produto' : 'Cadastro de Produto')

@section('content')
    <div class="container-fluid">
        <div class="border rounded mt-3">
            <form autocomplete="off" id="form-product" class="p-3" method="POST" action="{{ isset($product) ? route('dashboard.products.update', ['product' => $product->id]) : route('dashboard.products.store') }}">

                @csrf

                @if(isset($product))
                    @method('PUT')
                @endif

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{ old('name', @$product->name) }}">

                        @if ($errors->has('name'))
                            <div class="invalid-feedback font-weight-bold d-block">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-md-6">
                        <label for="barcode">Código de barras</label>
                        <input type="text" class="form-control" id="barcode" placeholder="Informe o Código de barra" name="barcode" value="{{ old('barcode', @$product->barcode) }}">

                        @if ($errors->has('barcode'))
                            <div class="invalid-feedback font-weight-bold d-block">
                                {{ $errors->first('barcode') }}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="price">Preço</label>
                        <input type="text" class="form-control price" id="price" placeholder="Informe o Preço" name="price" value="{{ old('price', @$product->price) }}">

                        @if ($errors->has('price'))
                            <div class="invalid-feedback font-weight-bold d-block">
                                {{ $errors->first('price') }}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="submit" class="btn btn-success" value="Salvar" />
                    </div>
                    <div class="form-group col-md-6">
                        <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-dark">Listagem de produtos</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script defer>
        $(function () {
            $('.price').mask('000.000.000.000.000,00', {reverse: true});// Aplicando máscara com Jquery Mask Plugin

            //INICIO DO SCRIPT DE VALIDAÇÃO COM PLUGIN JQUERY VALIDATION
            $('#form-product').validate({ // Inicializa o plugin
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    barcode: {
                        required: true,
                        maxlength: 255
                    },
                    price: {
                        required: true
                    }
                },
            });
            //FIM DO SCRIPT DE VALIDAÇÃO COM PLUGIN JQUERY VALIDATION
        })
    </script>
@endsection
