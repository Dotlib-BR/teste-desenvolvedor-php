@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Vagas</h2>
    <a href="{{ route('vagas.create') }}" class="btn btn-success">Nova Vaga</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vagas as $vaga)
            <tr>
                <td>{{ $vaga->id }}</td>
                <td>{{ $vaga->titulo }}</td>
                <td>{{ $vaga->descricao }}</td>
                <td>{{ $vaga->tipo }}</td>
                <td>{{ $vaga->status }}</td>
                <td>
                    <a href="{{ route('vagas.edit', $vaga->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('vagas.destroy', $vaga->id) }}" method="POST" class="d-inline">
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
