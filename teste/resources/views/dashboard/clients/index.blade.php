@extends('layouts.main')

@section('title', 'Clientes')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                @session
                @endsession
            </div>
        </div>
        @filter(['pages' => $pages])
        @endfilter

        <div class="row">
            <div class="col-md-12 text-center">
                <a class="text-success" href="{{ route('dashboard.clients.create') }}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> ADICIONAR</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table bg-dotlib table-responsive-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($clients as $client)
                        <tr>
                            <th scope="row">{{ $client->id }}</th>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email ?? '-' }}</td>
                            <td>{{ maskCpf($client->cpf) }}</td>
                            <td>
                                <form class="form-inline" action="{{ route('dashboard.clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Você tem certeza que deseja excluir este registro?')">
                                    @method('DELETE')
                                    @csrf

                                    <div class="form-group mr-3">
                                        <a class="text-decoration-none text-success" href="{{ route('dashboard.clients.show', $client->id) }}">
                                            <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <a class="text-decoration-none text-light" href="{{ route('dashboard.clients.edit', $client->id) }}">
                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary-outline"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p class="font-weight-bold">Total: <span class="text-light">{{ $pages->total }}</span></p>
            </div>
            <div class="col-md-10">
                @paginate(['pages' => $pages, 'params' => $params])
                @endpaginate
            </div>
        </div>
    </div>
@endsection

