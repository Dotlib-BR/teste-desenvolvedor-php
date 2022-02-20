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
                <table id="products">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor Unitário</th>
                            <th scope="col">Código de Barras</th>
                            <th scope="col">Detalhes</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td scope="row" data-label="#"> {{ $product->id }} </td>
                                <td data-label="Nome"> {{ $product->name }} </td>
                                <td data-label="Valor Unitário"> {{ number_format($product->price, 2, ',','.') }} </td>
                                <td data-label="Código de Barras"> {{ $product->barcode }} </td>
                                <td data-label="Detalhes">

                                    <a href="{{ route('product.get.detail', $product->id) }}">
                                        <button class="btn btn-outline-primary btn-rounded btn-icon">
                                        <i class="mdi mdi-account-search-outline"></i>
                                        </button>
                                    </a>
                                </td>
                                <td data-label="Editar">

                                    <a href="{{ route('product.get.edit', $product->id) }}">
                                        <button class="btn btn-outline-warning btn-rounded btn-icon">
                                        <i class="mdi mdi-grease-pencil"></i>
                                        </button>
                                    </a>
                                </td>
                                <td data-label="Deletar">
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
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
                },
                "lengthMenu": [ 20, 40, 60, 80, 100 ]
            });
        });
    </script>
@endsection
