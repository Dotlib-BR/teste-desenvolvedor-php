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
                <table id="purchases">
                    <thead>
                        <tr>
                            <th scope="col"> # </th>
                            <th scope="col"> Nome do Cliente </th>
                            <th scope="col"> Data </th>
                            <th scope="col"> Valor Total </th>
                            <th scope="col"> Status </th>
                            <th scope="col"> Detalhes </th>
                            <th scope="col"> Editar </th>
                            <th scope="col"> Deletar </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td scope="row" data-label="#"> {{ $purchase->id }} </td>
                                <td data-label="Nome do Cliente"> {{ $purchase->client->name }} </td>
                                <td data-label="Data"> {{ date('d/m/Y H:m', strtotime($purchase->date)) }} </td>
                                <td data-label="Valor Total"> {{ number_format($purchase->amount, 2, ',', '.') }} </td>
                                <td>
                                @if ($purchase->status === 'Em aberto')
                                <label class="badge badge-info">Em aberto</label>
                                @elseif ($purchase->status === 'Pago')
                                <label class="badge badge-success">Pago</label>
                                @else
                                <label class="badge badge-danger">Cancelado</label>
                                @endif
                            </td>   
                                <td data-label="Detalhes">

                                    <a href="{{ route('purchase.get.detail', $purchase->id) }}">
                                        <button class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi mdi-account-search-outline"></i>
                                        </button>
                                    </a>
                                </td>
                                <td data-label="Editar">

                                    <a href="{{ route('purchase.get.edit', $purchase->id) }}">
                                        <button class="btn btn-outline-warning btn-rounded btn-icon">
                                            <i class="mdi mdi-grease-pencil"></i>
                                        </button>
                                    </a>
                                </td>
                                <td data-label="Deletar">
                                    <form action="{{ route('purchase.put.deactive', $purchase->id) }}" method="POST">
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
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
                },
                "lengthMenu": [20, 40, 60, 80, 100]
            });
        });
    </script>
@endsection
