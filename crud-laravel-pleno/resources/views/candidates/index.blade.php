@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Candidatos</h2>
    <a href="{{ route('candidates.create') }}" class="btn btn-success">Novo Candidato</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates as $candidate)
            <tr>
                <td>{{ $candidate->id }}</td>
                <td>{{ $candidate->name }}</td>
                <td>{{ $candidate->email }}</td>
                <td>
                    <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
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
