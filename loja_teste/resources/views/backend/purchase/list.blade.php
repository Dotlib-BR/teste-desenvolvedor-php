@extends('layouts.app')
@section('content')
    <h3 class="page-title">Pedidos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('purchase.get.list') }}">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerenciar Pedidos</li>
        </ol>
    </nav>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pedidos Cadastrados</h4>
                <p class="card-description"> Lista os Pedidos cadastrados</code>
                </p>
                <table id="purchases" class="table table-bordered" style="width:100%">
                    <thead class="p5 mt5">
                        <tr>
                            <th> # </th>
                            <th> Nome </th>
                            <th> Cliente </th>
                            <th> Data </th>
                            <th> Valor Total </th>
                            <th> Detalhes </th>
                            <th> Editar </th>
                            <th> Deletar </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td> {{ $purchase->id }} </td>
                                <td> {{ $purchase->client_id }} </td>
                                <td> {{ $purchase->date }} </td>
                                <td> {{ number_format($purchase->amount, 2, ',','.') }} </td>
                                <td class="text-center">

                                    <a href="{{ route('purchase.get.detail', $purchase->id) }}">
                                        <button class="btn btn-outline-primary btn-rounded btn-icon">
                                        <i class="mdi mdi-account-search-outline"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">

                                    <a href="{{ route('purchase.get.edit', $purchase->id) }}">
                                        <button class="btn btn-outline-warning btn-rounded btn-icon">
                                        <i class="mdi mdi-grease-pencil"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('purchase.put.deactive', $purchase->id) }}"
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
            $('#purchases').DataTable({
                "scrollX": true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
                },
                "lengthMenu": [ 20, 40, 60, 80, 100 ]
            });
        });
    </script>
@endsection
