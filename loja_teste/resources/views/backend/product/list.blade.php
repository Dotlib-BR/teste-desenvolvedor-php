@extends('layouts.app')
@section('content')
    <h3 class="page-title">Produtos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('product.get.list') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerenciar Produtos</li>
        </ol>
    </nav>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Produtos Cadastrados</h4>
                <p class="card-description"> Lista os Produtos cadastrados</code>
                </p>
                <table id="products" class="table table-bordered" style="width:100%">
                    <thead class="p5 mt5">
                        <tr>
                            <th> # </th>
                            <th> Nome </th>
                            <th> Valor Unitário </th>
                            <th> Código de Barras </th>
                            <th> Detalhes </th>
                            <th> Editar </th>
                            <th> Deletar </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td> {{ $product->id }} </td>
                                <td> {{ $product->name }} </td>
                                <td> {{ number_format($product->amount, 2, ',','.') }} </td>
                                <td> {{ $product->barcode }} </td>
                                <td class="text-center">

                                    <a href="{{ route('product.get.detail', $product->id) }}">
                                        <button class="btn btn-outline-primary btn-rounded btn-icon">
                                        <i class="mdi mdi-account-search-outline"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">

                                    <a href="{{ route('product.get.edit', $product->id) }}">
                                        <button class="btn btn-outline-warning btn-rounded btn-icon">
                                        <i class="mdi mdi-grease-pencil"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('product.put.deactive', $product->id) }}"
                                        method="POST">
                                        <button class="btn btn-outline-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                        @method('PUT')
                                        @csrf
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- toast -->

    @include('layouts.components.toast')

    <!-- toast end -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#products').DataTable({
                "scrollX": true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
                },
                "lengthMenu": [ 20, 40, 60, 80, 100 ]
            });
        });
    </script>
@endsection
