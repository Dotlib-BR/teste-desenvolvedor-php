@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')    
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">{{ ! isset($product) ? 'Cadastrar' : 'Atualizar' }} Produto</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-primary" href="{{ route('products.index') }}">Listar Produtos</a>
                        </div>
                    </div>
                @endcomponent      
            </div>

            <div class="col-12">
                @component('components.card')    
                    <form action="{{ ! isset($product) ? route('products.store') : route('products.update', $product->id) }}" method="post">
                        @csrf

                        @isset($product)
                            @method('PUT')
                        @endisset

                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Digite o nome">
                                    @include('includes.form.validate', ['name' => 'name'])
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="price">Preço</label>
                                    <input id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" value="{{ old('price', $product->price ?? '') }}" step="0.01" placeholder="Digite o preço">
                                    @include('includes.form.validate', ['name' => 'price'])
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="bar_code">Código de Barras</label>
                                    <input id="bar_code" class="form-control {{ $errors->has('bar_code') ? 'is-invalid' : '' }}" type="text" name="bar_code" value="{{ old('bar_code', $product->bar_code ?? '') }}" maxlength="20" placeholder="Digite o código de barras">
                                    @include('includes.form.validate', ['name' => 'bar_code'])
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group text-right mb-0">
                                    @include('includes.form.submit')
                                </div>
                            </div>
                        </div>
                    </form>
                @endcomponent      
            </div>
        </div>
    </div>
@endsection