@extends('layouts.masterAdmin')
@section('title', 'Admin - Pedido ')
@section('content')
pedido pa nois

<p>nºPedido: {{$order['data']['n_order']}} Status: {{$order['data']['status']}}</p>
<div>
    <p>Comprador: {{$order['data']['user']['name'] . ' ' . $order['data']['user']['last_name']}}</p>
    <p>CPF: {{$order['data']['user']['document']}}</p>
    <p>E-mail: {{$order['data']['user']['email']}}</p>
</div>
<br><br><br>
<div>
    <div class="error__delete">
        
    </div>
    Produtos

    @foreach($order['data']['orderProduct'] as $product)
    {{-- @dd($product['product']['discount_status']) --}}
    <div>
        <p>Nome do Produto: {{$product['product']['name_product']}}</p>
        <p>Quantidade: {{$product['quantity']}}</p>
        <p>Preço dos Itens: {{$product['price']}}</p>
        <p>Preço unitario: {{$product['price'] / $product['quantity']}}</p>
    </div>
    <br><br>
    @endforeach

    <p>Total a pagar: {{$order['data']['total_price']}}</p>
</div>

<form action="{{route('updateOrderAdmin', $order['data']['id'])}}" method="post">
    @csrf
    @method('PUT')
    <select name="status" onchange="this.form.submit()">
        <option @if($order['data']['status'] === 'Em aberto') selected @endif value="0">Em aberto</option>
        <option @if($order['data']['status'] === 'Concluído') selected @endif value="1">Concluído</option>
        <option @if($order['data']['status'] === 'Cancelado') selected @endif value="2">Cancelado</option>
    </select>
</form>

<button class="delete__order">Deletar pedido</button>
@endsection