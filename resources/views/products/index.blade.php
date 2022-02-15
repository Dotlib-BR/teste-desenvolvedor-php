@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Produtos</h1>

                <a class="btn btn-primary mb-2" href="{{ route('products.create') }}">Cadastrar produtos</a>

                @if(!empty($products))
                    <table class="table table-bordered table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Código de Barras</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td class="text-right">{{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="d-flex justify-content-around">
                                    <a class="btn btn-outline-info" href="{{ route('products.edit', $product) }}"><i class="fas fa-edit"></i></a>
                                    <form id="delete-product{{$product->id}}" method="POST" action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="btn btn-outline-danger" href="#" onclick="deleteConfirm('delete-product{{$product->id}}')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                @else
                    <h2>Nenhum cliente cadastrado!</h2>
                @endif

            </div>
        </div>
    </div>
@endsection
