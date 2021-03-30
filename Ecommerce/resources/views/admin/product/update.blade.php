@extends('layouts.masterAdmin')
@section('title', 'Admin - Editar Produto')
@section('content')
    <h1>Editar Produto</h1>

    <form action="{{ route('updateProduct', $product->id) }}" method="post" enctype="multipart/form-data"2>
        @csrf
        @method('PUT')
        <div>
            <input type="text" name="name_product" value="{{ $product->name_product }}" placeholder="Nome do Produto">
            <p>@error('name_product') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" name="price" value="{{ $product->price }}" placeholder="Preço">
            <p>@error('price') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" name="code" value="{{ $product->code }}" placeholder="Código de Barras">
            <p>@error('code') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" name="discount" value="{{ $product->discount }}" placeholder="Desconto">
            <p>@error('discount') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="checkbox" @if($product->discount_status === '1') checked @endif name="discount_status">
        </div>

        <div>
            <input type="file" name="image" >
        </div>
        <button type="submit">
            Editar
        </button>
    </form>

    <button class="delete__product">Deletar Produto</button>
@endsection
