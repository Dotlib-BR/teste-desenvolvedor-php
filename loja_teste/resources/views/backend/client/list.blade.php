@extends('layouts.app')
@section('content')
    <h3 class="page-title">Clientes</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('client.get.list') }}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerenciar Clientes</li>
        </ol>
    </nav>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Clientes Cadastrados</h4>
                <p class="card-description"> Lista os clientes cadastrados</code>
                </p>
                <table id="clients">
                    <thead class="p5 mt5">
                        <tr>
                            <th scope="col"> # </th>
                            <th scope="col"> Nome </th>
                            <th scope="col"> CPF </th>
                            <th scope="col"> E-mail </th>
                            <th scope="col"> Detalhes </th>
                            <th scope="col"> Editar </th>
                            <th scope="col"> Deletar </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td scope="row" data-label="#"> {{ $client->id }} </td>
                                <td data-label="Nome"> {{ $client->name }} </td>
                                <td data-label="CPF"> {{ $client->cpf }} </td>
                                <td data-label="E-mail"> {{ $client->email }} </td>
                                <td data-label="Detalhes">

                                    <a href="{{ route('client.get.detail', $client->id) }}">
                                        <button class="btn btn-outline-primary btn-rounded btn-icon">
                                        <i class="mdi mdi-account-search-outline"></i>
                                        </button>
                                    </a>
                                </td>
                                <td data-label="Editar">

                                    <a href="{{ route('client.get.edit', $client->id) }}">
                                        <button class="btn btn-outline-warning btn-rounded btn-icon">
                                        <i class="mdi mdi-grease-pencil"></i>
                                        </button>
                                    </a>
                                </td>
                                <td data-label="Deletar">
                                    <form action="{{ route('client.put.deactive', $client->id) }}"
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
            $('#clients').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
                },
                "lengthMenu": [ 20, 40, 60, 80, 100 ]
            });
        });
    </script>
@endsection
