@extends('layouts.dashboard')

@section('title', $title)

@section('content')
<style>
.removeRow
{
 background-color: #FF0000;
    color:#FFFFFF;
}
</style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    @if (isset($adm) && $adm == '1')
                        <h4><a href="{{ route('announcement.adm.create') }}"
                                class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5"><i
                                    class="ti-plus"></i>Criar Anúncio</a>
                                </h4>
                        @if (session('msg'))
                            <div class="alert alert-success" id="msg">
                                {{ session('msg') }}
                            </div>
                        @endif
                    @endif
                    @if (session('linked_vacancy'))
                        <div class="alert alert-success" id="msg">
                            {{ session('linked_vacancy') }}
                        </div>
                    @endif
                    <div class="msg" style="display: none;">
                        <div class="alert alert-success" id="msg">
                            Dados selecionados excluidos.
                        </div>
                    </div>
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="table_id">
                            <thead>
                                <tr>
                                    <th>
                                        <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-sm">Delete</button>
                                        <label><input type="checkbox" id="checkTodos" name="checkTodos"> Selecionar Todos</label>
                                    </th>
                                    <th>ID</th>
                                    <th>Empresa</th>
                                    <th>Título</th>
                                    <th>Salário</th>
                                    <th>Status</th>
                                    <th>Tipo de Vaga</th>
                                    <th>Data de Cadastro</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $announcement)
                                    <tr>
                                        <td>  <input type="checkbox" class="delete_checkbox" value="{{  $announcement->id }}"></td>
                                        <td >{{ $announcement->id }}</td>
                                        <td>{{ $announcement->company->name ?? $announcement->company_name }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ formatarValoresReal($announcement->remuneration) }}</td>
                                        <td>
                                            {{ formatarStatusVaga($announcement->active) }}
                                        </td>
                                        <td>{{ $announcement->vacancy_type }}</td>
                                        <td>{{ formatarData($announcement->created_at) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @if (isset($adm) && $adm == '1')
                                                    <div class="btn-group">
                                                        <a href="{{ route('announcement.adm.edit', $announcement->id) }}" class="btn btn-warning btn-sm" title="Editar"><i
                                                                class="ti-pencil"></i></a>
                                                        <form action="{{ route('announcement.adm.delete', $announcement->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Excluir" onclick="return confirm('Deseja excluir o usuário?')"><i class="ti-trash"></i></button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <a href="#"
                                                        class="btn btn-warning btn-sm
                                                        @if ($announcement->active == '0')
                                                            {{ 'disabled' }}
                                                        @endif"
                                                        title="Detalhes" data-toggle="modal"
                                                        data-target="#exampleModal_{{ $announcement->id }}">
                                                        <i class="ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('announcement.show', $announcement->id) }}"
                                                        class="btn btn-primary btn-sm @if ($announcement->active == '0') {{ 'disabled' }}  @endif"
                                                        title="Tenho Intersse"><i class="ti-thumb-up"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_{{ $announcement->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        ID: {{ $announcement->id }} <br>
                                                        Empresa:{{ $announcement->company->name ?? $announcement->company_name }}
                                                    </h5>
                                                    <hr>

                                                </div>
                                                <div class="modal-body">
                                                    Descrição: <p>
                                                        {{ $announcement->description }}
                                                    </p>
                                                    <hr>
                                                    Salário até:{{ formatarValoresReal($announcement->remuneration) }}
                                                    Data do Anúncio:{{ formatarData($announcement->created_at) }} até
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
