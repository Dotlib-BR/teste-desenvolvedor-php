@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Criar Produto</h5>
                    <hr>
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-tag }}"></i>
                                        </div>
                                    </span>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Nome" maxlength="100" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-dollar-sign }}"></i>
                                        </div>
                                    </span>
                                    <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="Preço" step="0.01" value="{{ old('price') }}" min="0" required>
                                    @if ($errors->has('price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-barcode }}"></i>
                                        </div>
                                    </span>
                                    <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" placeholder="Código de barras" maxlength="20" value="{{ old('code') }}" required>
                                    @if ($errors->has('code'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Criar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
