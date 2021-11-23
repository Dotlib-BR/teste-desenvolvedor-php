@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    @if (session('vaga_vinculada'))
                        <div class="alert alert-success" id="msg">
                            {{ session('vaga_vinculada') }}
                        </div>
                    @endif
                    @if (session('user_delete'))
                        <div class="alert alert-danger" id="msg">
                            {{ session('user_delete') }}
                        </div>
                    @endif
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Empresa</th>
                                    <th>Título</th>
                                    <th>Salário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($annuncement as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->company_name }}</td>
                                        <td>{{ $a->title }}</td>
                                        <td>{{ $a->remuneration }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning btn-sm" title="Detalhes"
                                                    data-toggle="modal" data-target="#exampleModal"><i
                                                        class="ti-eye"></i></button>
                                                <form action="{{ route('announcement.destroy') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $a->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Desistir"
                                                        style="border-radius:0;" onclick="return confirm('Deseja excluir a sua candidatura?')"><i class="ti-thumb-down"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Informações sobre a vaga
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Registro:</b> {{ $a->id }}
                                                    <b>Nome da empresa:</b><br>{{ $a->company_name ?? $a->company->name }}
                                                    <hr>
                                                    <b>Descrição da vaga:</b><br>{{ $a->description }}
                                                    <hr>
                                                    <b>Data da publicação:</b><br>{{ formatarData($a->created_at) }} até
                                                    {{ date('d/m/Y', strtotime('now')) }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
