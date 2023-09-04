@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listagem de Vagas</h2>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Criar Nova Vaga</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->titulo }}</td>
                <td>{{ $job->descricao }}</td>
                <td>{{ $job->tipo }}</td>
                <td>{{ $job->status }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
