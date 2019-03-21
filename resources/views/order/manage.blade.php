@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')    
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">{{ ! isset($order) ? 'Cadastrar' : 'Atualizar' }} Pedido</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-primary" href="{{ route('orders.index') }}">Listar Pedidos</a>
                        </div>
                    </div>
                @endcomponent      
            </div>

            <div class="col-12">
                <form action="{{ ! isset($order) ? route('orders.store') : route('orders.update', $order->id) }}" method="post">
                    @csrf

                    @isset($order)
                        @method('PUT')
                    @endisset

                    <div class="row">
                        <div class="col-md-9 mb-3 mb-md-0">
                            @component('components.card')
                                <div class="form-row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">Produtos</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="bag-tab" data-toggle="tab" href="#bag" role="tab" aria-controls="bag" aria-selected="false">Meu Carrinho</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                                                @component('components.table')
                                                    <thead>
                                                        <th>Produto</th>
                                                        <th>Preço</th>
                                                        <th>Código de Barras</th>
                                                        <th width="150px">Quantidade</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($products as $product)    
                                                            <tr class="product-line">
                                                                <td>{{ $product->name }}</td>
                                                                <td>R$ {{ $product->price_full }}</td>
                                                                <td>{{ $product->bar_code }}</td>
                                                                <td><input class="form-control" type="number" name="qtd" value=""></td>
                                                                <td class="text-center text-md-right">
                                                                    <button class="btn btn-success add-product" type="button" data-id="{{ $product->id }}"><b>+</b></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach          
                                                    </tbody>
                                                @endcomponent
                                            </div>
                                            <div class="tab-pane fade" id="bag" role="tabpanel" aria-labelledby="bag-tab">
                                                <div id="products-table" class="{{ ! session()->has('cart') ? 'd-none' : '' }}">
                                                    @component('components.table')
                                                        <thead>
                                                            <th>Produto</th>
                                                            <th>Preço</th>
                                                            <th>Quantidade</th>
                                                        </thead>
                                                        <tbody class="products-added">
                                                            @if (session()->has('cart'))
                                                                @foreach (session()->get('cart.items') as $item)
                                                                    <tr>
                                                                        <td>{{ $item["name"] }}</td>
                                                                        <td>{{ $item["price_full"] }}</td>
                                                                        <td>{{ $item["quantity"] }}</td>
                                                                        <td>
                                                                            <button class="btn btn-danger remove-product" type="button" data-id="{{ $item["product_id"] }}"><b>-</b></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            <tr>
                                                                <td colspan="4" class="text-right"><b>Total: R$ {{ session()->get('cart.total') }} </b></th>
                                                            </tr>
                                                        </tbody>
                                                    @endcomponent
                                                </div>

                                                @if (! session()->has('cart'))
                                                    <div id="cart-alert" class="mt-3">
                                                        @include('partials.alert', [
                                                            'type' => 'info', 
                                                            'message' => 'Você ainda não adicionou produtos ao carrinho.'
                                                        ])
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('components.card')
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="number">Número do Pedido</label>
                                            <input id="number" class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number" name="number" value="{{ old('number', $order->number ?? '') }}" min="0" max="99999" placeholder="Digite o nº do pedido" required>
                                            @include('includes.form.validate', ['name' => 'number'])
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="client_id">Cliente</label>
                                            <select id="client_id" class="form-control {{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id" required>
                                                <option selected hidden disabled value="">Selecione</option>

                                                @forelse ($clients as $c)
                                                    <option value="{{ $c->id }}" {{ old('client_id', isset($order) ? $order->client->id : '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                                @empty
                                                    
                                                @endforelse
                                            </select>
                                            @include('includes.form.validate', ['name' => 'client_id'])
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="status_id">Status</label>
                                            <select id="status_id" class="form-control {{ $errors->has('status_id') ? 'is-invalid' : '' }}" name="status_id" required>
                                                <option selected hidden disabled value="">Selecione</option>

                                                @foreach ($statuses as $s)
                                                    <option value="{{ $s->id }}" {{ old('status_id', isset($order) ? $order->status->id : '') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                                @endforeach
                                            </select>
                                            @include('includes.form.validate', ['name' => 'status_id'])
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="discount">Desconto</label>
                                            <input id="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" value="{{ old('discount', $order->discount ?? '') }}" step="0.01" min="0" placeholder="Digite o desconto">
                                            @include('includes.form.validate', ['name' => 'discount'])
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group text-right mb-0">
                                            @include('includes.form.submit')
                                        </div>
                                    </div>
                                </div>
                            @endcomponent
                        </div>
                    </div>
                </form>    
            </div>
        </div>
    </div>
@endsection