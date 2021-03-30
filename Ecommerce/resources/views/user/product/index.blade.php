@extends('layouts.master')
@section('title', 'Produtos')
@section('content')
@foreach($products['data'] as $product)
<div>
    <a href="{{route('showProduct', $product->id)}}">
        <p>Nome: {{$product->name_product}}</p>
        <p>preco: <b>R$:{{$product->price}}</b></p>
    </a>
</div>
@endforeach
@endsection