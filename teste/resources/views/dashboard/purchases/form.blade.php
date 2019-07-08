@extends('layouts.main')

@section('title', isset($purchase) ? 'Edição de Pedido' : 'Cadastro de Pedido')

@section('content')
    <div class="container-fluid">
        <div class="border rounded mt-3">
            <form autocomplete="off" id="form-orders" class="p-3" method="POST" action="{{ isset($purchase) ? route('dashboard.purchases.update', ['purchase' => $purchase->id]) : route('dashboard.purchases.store') }}">

                @csrf

                @if(isset($purchase))
                    @method('PUT')
                @endif

                <div class="row mt-3 mb-3">
                    <div class="col-md-6 text-right">
                        <h1>PEDIDO DE COMPRA</h1>
                    </div>
                    <div class="col-md-6 text-left">

                        @if(count($errors) > 0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
                <div id="dynamic_field">
                    <div class="row m-3">
                        <div>
                            <input type="number" name="quantity[]" placeholder="Quantidade" class="form-control quantity_list" required="" value="{{ old('quantity')[0] ? old('quantity')[0] : @$firstQuantity }}"/>
                            <select data-live-search="true" name="product_id[]" class="selectpicker m-2 form-control" data-width="fit" data-style="btn-success">
                                <option value="0" data-subtext="Selecione um item">Produto</option>

                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-subtext="ID #{{ $product->id }}"{{ old('product_id')[0] == $product->id || @$firstProduct == $product->id ? 'selected="selected"':'' }}>{{ $product->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <button type="button" name="add" id="add" class="btn btn-outline"><i class="fa fa-plus-square-o fa-2x"  aria-hidden="true"></i></button>
                        </div>
                    </div>

                    @if(old('quantity', @$purchase->orders))
                        @foreach(old('quantity', @$purchase->orders) as $key => $value)

                            @if($key === 0) @continue @endif

                                <div id="row{{ $key }}" class="dynamic-added row m-3"><div>
                                    <input type="number" name="quantity[]" placeholder="Quantidade" value="{{ is_numeric($value) ? $value : $value->quantity }}" class="form-control quantity_list" required="" />
                                    <select data-live-search="true" name="product_id[]" class="selectpicker m-2 form-control" data-width="fit" data-style="btn-success">
                                        <option value="0" data-subtext="Selecione um item">Produto</option>

                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-subtext="ID #{{ $product->id }}"{{ old('product_id')[$key] == $product->id || @$value->product_id == $product->id ? 'selected="selected"':'' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div>
                                    <button type="button" name="remove" id="{{ $key }}" class="btn btn-outline btn_remove">
                                        <i class="fa fa-trash-o fa-2x"  aria-hidden="true">
                                        </i>
                                    </button>
                                </div>
                            </div>

                        @endforeach
                    @endif

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>CUPOM DE DESCONTO</label>
                        <select data-live-search="true" name="discount_id" class="selectpicker m-2 form-control" data-width="fit" data-style="btn-dark">
                            <option value="0" >Nenhum cupom</option>

                            @foreach($discounts as $discount)
                                <option value="{{ $discount->id }}" {{ old('discount_id', @$purchase->discount_id) == $discount->id ? 'selected="selected"':'' }} data-subtext="{{ $discount->percentage.'%' }}">
                                    {{ $discount->code }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>STATUS DO PEDIDO</label>
                        <select name="status_id" class="selectpicker m-2 form-control" data-width="fit" data-style="btn-light">
                            <option value="0" data-subtext="Selecione um status">Status</option>

                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ old('status_id', @$purchase->status_id) == $status->id ? 'selected="selected"':'' }}>
                                    {{ $status->title }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>COMPRADOR</label>
                        <select data-live-search="true" name="client_id" class="selectpicker m-2 form-control" data-width="fit" data-style="btn-success">
                            <option value="0" data-subtext="Selecione um comprador">Cliente</option>

                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"  {{ old('client_id', @$purchase->client_id) == $client->id ? 'selected="selected"':'' }} data-subtext="{{ maskCpf($client->cpf) }}">
                                    {{ $client->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-6">
                        <input type="submit" class="btn btn-success" value="Salvar"/>
                    </div>
                    <div class="form-group col-md-6">
                        <a href="{{ route('dashboard.purchases.index') }}" class="btn btn-outline-dark">Listagem de pedidos de compras</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script defer>
        $(function () {
            var i = 1;// Numerador, preciso dele fora e declarado como var para ter escopo global.

            $('#add').click(function(){
                // Quando clica no icone de add um produto a lista de pedido de compra ele cria uma estrutura nova.
                i++;

                $('#dynamic_field')
                    .append('<div id="row'+i+'" class="dynamic-added row m-3"><div>' +
                        '<input type="number" name="quantity[]" placeholder="Quantidade" class="form-control quantity_list" required="" />'+
                        '<select data-live-search="true" name="product_id[]" class="selectpicker m-2 form-control" data-width="fit" data-style="btn-success"><option value="0" data-subtext="Selecione um item">Produto</option>@foreach($products as $product)<option value="{{ $product->id }}" data-subtext="ID #{{ $product->id }}" >{{ $product->name }}</option>@endforeach</select>' +
                        '</div>' +
                        '<div>' +
                        '<button type="button" name="remove" id="'+i+'" class="btn btn-outline btn_remove">' +
                        '<i class="fa fa-trash-o fa-2x"  aria-hidden="true">' +
                        '</i>' +
                        '</button>' +
                        '</div>' +
                        '</div>');

                $('select').selectpicker();
            });

            $(document).on('click', '.btn_remove', function(){
                // Quando clicar no icone da lixeira eu pego o id do item da lista e removo toda a linha.
                let button_id = $(this).attr("id");

                $('#row'+button_id+'').remove();
            });

        })
    </script>
@endsection
