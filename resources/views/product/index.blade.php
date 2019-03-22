@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">Lista de Produtos</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-success" href="{{ route('products.create') }}">Adicionar Produto</a>
                        </div>
                    </div>
                @endcomponent
            </div>

            <div class="col-12 mb-3">
                <form action="{{ route('products.filter') }}" method="get">
                    <div class="row">
                        <div class="col-12 mb-3">
                            @component('components.card')
                                @include('partials.filter', [
                                    'count_results' => request()->get('filter') ? $products->count() : '',
                                    'options' => [
                                        'name' => 'Nome',
                                        'price' => 'Preço',
                                        'bar_code' => 'Código de Barras',
                                    ],
                                    'placeholder' => 'Busque pelo nome, preço ou código de barras do produto.'
                                ])
                            @endcomponent
                        </div>

                        <div class="col-12 col-sm-2 mb-2">
                            @include('partials.paginate')
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                @if (isset($products))
                    @component('components.table')
                        <thead>
                            <th>
                                <a class="text-muted" href="{{ route('products.filter', ['order' => 'name', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Nome</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('products.filter', ['order' => 'price', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Preço</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('products.filter', ['order' => 'bar_code', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Código de Barras</a>
                            </th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)    
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>R$ {{ $product->price_full }}</td>
                                    <td>{{ $product->bar_code }}</td>
                                    <td class="text-center text-md-right">
                                        <a class="btn btn-sm btn-primary mb-2 mb-md-0" href="{{ route('products.edit', $product->id) }}">Editar</a>
                                        <button class="btn btn-sm btn-danger" type="button" data-action="{{ route('products.destroy', $product->id) }}" data-toggle="modal" data-target="#modalDestroyConfirm">Remover</button>
                                    </td>
                                </tr>
                            @endforeach          
                        </tbody>
                    @endcomponent

                    <div class="d-flex justify-content-center mt-3">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('modal')
    @include('includes.modal-destroy-confirm')
@endpush