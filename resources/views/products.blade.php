@extends('_template')

@section('content')
    <h1 class="text-center mt-4">Produtos <a href="{{ route('web.create', ['table' => 'produto']) }}" class=""><i class="bi-plus-square"></i></a></h1>

    <div class="row mt-4">
        <div class="col text-center text-muted">
            <div class="container">
                <table class="table rounded-top">
                    <thead class="table-dark ">
                        <tr>
                            <th scope="col"><a href="{{ route('web.filterProducts', ['filter' => 'name']) }}">Nome</a>
                            </th>
                            <th scope="col"><a href="{{ route('web.filterProducts', ['filter' => 'bar_code']) }}">Código
                                    de barras</a> </th>
                            <th scope="col"><a href="{{ route('web.filterProducts', ['filter' => 'price']) }}">Preço</a>
                            </th>
                            <th scope="col"> </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td> {{ $product->bar_code }}</td>
                                <td>{{ $product->price }}</td>
                                <td><a href="{{ route('web.view', ['table' => 'produto', 'id' => $product->id]) }}"><i
                                    class="bi-eye"></i></a></td>
                                <td><a href="{{ route('web.edit', ['table' => 'produto', 'id' => $product->id]) }}"><i
                                            class="bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0"><i class="bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>



        </div>
        <div class="row my-3">
            <div class="col d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
