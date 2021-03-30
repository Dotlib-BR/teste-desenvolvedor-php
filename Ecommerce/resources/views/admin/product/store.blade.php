@extends('layouts.masterAdmin')
@section('title', 'Admin - Registrar Produto')
@section('content')
    <h1>Registrar Produto</h1>

    <form action="{{ route('storeProduct') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="text" name="name_product" value="{{ old('name_product') }}" placeholder="Nome do Produto">
            <p>@error('name_product') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" name="price" value="{{ old('price') }}" placeholder="Preço">
            <p>@error('price') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" name="code" value="{{ old('code') }}" placeholder="Código de Barras">
            <p>@error('code') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" name="discount" placeholder="Desconto">
            <p>@error('discount') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="checkbox" name="discount_status">
        </div>

        <div>
            <input type="file" name="image">
        </div>
        <button type="submit">
            Cadastrar
        </button>
    </form>

@endsection
